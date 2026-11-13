<?php
namespace App\Http\Controllers\Admin\Menu;

use Illuminate\Http\Request;

trait MenuTraitSeason
{
    public function season(Request $request) : \Illuminate\View\View
    {
        $srch = $this->season_srch($request);
        $rows = $this->season_load($srch);
        return view("admin.menu.season.main", compact(["rows", "srch"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************

    /**
     * swapでもsrchを積むのでpublic。
     */
    public function season_srch(Request $request) : array
    {
        $month = $request->query("srch_month", \Carbon\Carbon::today()->format("m"));
        $pre_month = ($month - 1 + 12) % 12;
        $next_month = ($month + 1 + 12) % 12;
        $srch = [
            "pre_month" => $pre_month,
            "srch_month" => $month,
            "next_month" => $next_month,
        ];
        return $srch;
    }

    private function season_load(array $srch) : array
    {
        $q = \App\Models\Menu::query();
        $q->select([
            "menu.id AS id",
            "menu.name AS name",
            "menu.memo AS memo",
            "menu.servedate AS servedate",
            "recipe.url AS recipe_url",
            "recipe.memo AS recipe_memo",
        ]);
        $q->leftJoin("recipe", "recipe.id", "=", "menu.recipe_id");
        // $q->whereIn(\DB::raw("MONTH(menu.servedate)"), [$srch["pre_month", $srch["srch_month"], $srch["next_month"]]]);
        $q->whereMonth("menu.servedate",$srch["srch_month"]);
        $q->where("menu.timing", \App\L\MenuTiming::ID_DINNER); // 晩御飯だけ
        $q->orderBy("menu.servedate", "ASC");
        $raws = $q->get();
        $rows = $this->season_make($raws, $srch);
        return $rows;
    }

    private function season_make(\Illuminate\Support\Collection $rows, array $srch) : array
    {
        $ret = [];

        // はじめに年の枠
        $range = ["max" => 0, "min" => PHP_INT_MAX];
        foreach($rows as $row) {
            $date = \Carbon\Carbon::parse($row->servedate);
            $range["max"] = max($range["max"], $date->year);
            $range["min"] = min($range["min"], $date->year);
        }

        // 最大日数31日で日付枠を作成。各要素は↑のloadに従う
        for($day = 1; $day <= 31; $day++) {
            $ret[$day] = [];
            for($year = $range["min"]; $year <= $range["max"]; $year++) {
                $ret[$day][$year] = [];
            }
        }

        // ロードした値をあてはめ
        foreach($rows as $row) {
            $date = \Carbon\Carbon::parse($row->servedate);
            $ret[$date->day][$date->year][] = $row;
        }

        return $ret;
    }


}
