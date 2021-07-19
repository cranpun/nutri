<?php

namespace App\Http\Controllers\Admin\Menu;

trait MenuTraitUpdate
{
    public function update(\Illuminate\Http\Request $request, $servedate, $timing)
    {
        $menumax = 5;
        $rows = $this->update_loadMenus($servedate, $timing, $menumax);
        $foods = $this->update_loadFoods();
        $menufoods = $this->update_loadMenufoods($rows, $foods);
        $lackrecomand = $this->update_loadLackRecomand($servedate);
        return view("admin.menu.update.main", compact(["rows", "menufoods", "foods", "servedate", "timing", "menumax"]) + $lackrecomand);
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function update_loadMenus($servedate, $timing, $menumax)
    {
        // 昼食と夕食
        $q = \App\Models\Menu::query();
        $q->where("menu.servedate", "=", $servedate);
        $q->where("menu.timing", "=", $timing);
        $q->select([
            "menu.id AS id",
            "menu.name AS name",
        ]);
        $raws = $q->get();

        // 最大数まで補完
        $ret = [];
        for ($i = 0; $i < $menumax; $i++) {
            $ret[] = count($raws) > $i ? $raws[$i] : ["name" => "", "id" => 0];
        }

        return $ret;
    }

    private function update_loadMenufoods($rows, $foods)
    {
        $ret = [];
        // foodとmenumaxで補完した配列を構成
        foreach($rows as $idx => $row) {
            $q = \App\Models\Menufood::query();
            $q->where("menufood.menu_id", "=", $row["id"]);
            $raws = $q->get()->toArray();
            // food_idの連想配列に変換
            $menufood_ids = array_column($raws, "food_id");

            // foodで補完した配列に
            $data = [];
            foreach($foods as $food) {
                $data[$food->id] = in_array($food->id, $menufood_ids);
            }

            $ret[$idx] = $data;
        }
        return $ret;
    }
    private function update_loadFoods()
    {
        $q = \App\Models\Food::query();
        $q->orderBy("favorite", "ASC");
        $q->orderBy("category", "ASC");
        $raws = $q->get();
        $ret = [];
        // 背景色の設定
        foreach($raws as $raw) {
            $raw["bgcolor"] = $this->update_favoritecolor($raw["favorite"]);
            $ret[] = $raw;
        }
        return $ret;
    }

    private function update_favoritecolor($fav) 
    {
        $colors = [
            0 => "has-background-primary-light",
        ];
        if(array_key_exists($fav, $colors)) {
            return $colors[$fav];
        } else {
            return "";
        }
    }

    private function update_loadLackRecomand($servedate)
    {
        $rangeday = 15;
        $startdate = \Carbon\Carbon::parse($servedate)->addDay($rangeday * -1)->format("Y-m-d");
        $enddate = \Carbon\Carbon::parse($servedate)->addDay($rangeday * 1)->format("Y-m-d");

        // 範囲内で摂取された食材のID
        $rq = \App\Models\Menufood::query();
        $rq->join("menu", "menu.id", "=", "menufood.menu_id");
        $rq->whereBetween("menu.servedate", [$startdate, $enddate]);
        $rq->groupBy(["menufood.food_id"]);
        $rq->select([
            "menufood.food_id AS food_id",
        ]);
        $rrows = $rq->get()->toArray();
        $rids = array_column($rrows, "food_id");

        // 指定された食材IDが持つ栄養所のID
        $nq = \App\Models\Foodnutri::query();
        $nq->whereIn("foodnutri.food_id", $rids);
        $nq->groupBy(["foodnutri.nutri_id"]);
        $nq->select([
            "foodnutri.nutri_id AS nutri_id",
        ]);
        $nrows = $nq->get()->toArray();
        $nids = array_column($nrows, "nutri_id");

        // 不足する栄養素
        $lq = \App\Models\Nutri::query();
        $lq->whereNotIn("nutri.id", $nids);
        $lq->select([
            "nutri.name AS name",
        ]);
        $lrows = $lq->get()->toArray();
        $lacknutris = array_column($lrows, "name");

        // 指定された栄養素以外を含む食材の名前
        $fq = \App\Models\Foodnutri::query();
        $fq->join("food", "food.id", "=", "foodnutri.food_id");
        $fq->whereNotIn("foodnutri.nutri_id", $nids);
        $fq->groupBy(["food.id", "food.name"]);
        $fq->select([
            "food.id AS id",
            "food.name AS name",
        ]);
        $frows = $fq->get()->toArray();
        $recomandfoods = array_column($frows, "id");
        return compact(["lacknutris", "recomandfoods"]);
    }
}