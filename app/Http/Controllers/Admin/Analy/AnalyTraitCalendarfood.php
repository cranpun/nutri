<?php

namespace App\Http\Controllers\Admin\Analy;

use Illuminate\Http\Request;

trait AnalyTraitCalendarfood
{
    public function calendarfood(\Illuminate\Http\Request $request) : \Illuminate\View\View
    {
        $NAME_START = "startdate";
        $NAME_END = "enddate";
        $srch = $this->calendarfood_srch($request, $NAME_START, $NAME_END);

        // servedateを補完しつつ、servedate x timingの連想配列を構成
        $period = \Carbon\CarbonPeriod::create($srch[$NAME_START], $srch[$NAME_END])->toArray();

        $foods = $this->calendarfood_foods();
        $rows = $this->calendarfood_initdata($foods, $period);
        $raws = $this->calendarfood_load($srch, $NAME_START, $NAME_END);
        $rows = $this->calendarfood_make($raws, $rows);

        return view("admin.analy.calendarfood.main", compact(["rows", "srch", "period", "foods", "NAME_START", "NAME_END"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function calendarfood_srch(\Illuminate\Http\Request $request, string $NAME_START, string $NAME_END): array
    {
        $range = config("myconf.nutrioffset");
        $srch = [
            $NAME_START => $request->query($NAME_START, \Carbon\Carbon::today()->addDays(intval($range * -1))->format("Y-m-d")),
            $NAME_END => $request->query($NAME_END, \Carbon\Carbon::today()->addDays(intval($range * 1))->format("Y-m-d")),
        ];
        return $srch;
    }

    private function calendarfood_foods(): array
    {
        $q = \App\Models\Food::query();
        $q->select([
            "food.id AS id",
            "food.name AS name",
            "food.favorite AS favorite",
            \DB::raw((new \App\L\FoodCategory())->sqlCase("food.category", "category")),
        ]);
        $q->orderBy("favorite", "ASC");
        $q->orderBy("category", "ASC");
        $raws = $q->get();
        $ret = [];
        foreach($raws as $raw) {
            $raw["bgcolor"] = $raw->favorite === 0 ? 'has-background-primary-light' : '';
            $ret[$raw->id] = $raw;
        }
        return $ret;
    }

    private function calendarfood_initdata(array $foods, array $period) : array
    {
        $ret = [];
        foreach ($foods as $food) {
            $row = [];
            foreach ($period as $perioddate) {
                $str_perioddate = $perioddate->format("Y-m-d");
                $row[$str_perioddate] = 0;
            }
            $ret[$food->id] = $row;
        }
        return $ret;
    }

    private function calendarfood_load(array $srch, string $NAME_START, string $NAME_END) : \Illuminate\Support\Collection
    {
        $q = \App\Models\Menufood::query();
        $q->join("menu", "menu.id", "=", "menufood.menu_id");
        $q->select([
            "menufood.food_id AS food_id",
            "menu.servedate AS servedate",
        ]);
        $q->whereBetween("menu.servedate", [$srch[$NAME_START], $srch[$NAME_END]]);
        $q->orderBy("menu.servedate", "ASC");
        $raws = $q->get();
        return $raws;
    }

    private function calendarfood_make(\Illuminate\Support\Collection $raws, array $rows) : array
    {
        foreach ($raws as $raw) {
            $food_id = $raw->food_id;
            $servedate = $raw->servedate;
            $rows[$food_id][$servedate]++;
        }
        return $rows;
    }
}
