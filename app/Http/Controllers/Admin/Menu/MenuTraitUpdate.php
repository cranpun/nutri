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
        return view("admin.menu.update.main", compact(["rows", "menufoods", "foods", "servedate", "timing", "menumax"]));
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
}
