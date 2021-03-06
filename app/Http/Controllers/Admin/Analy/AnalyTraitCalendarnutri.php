<?php

namespace App\Http\Controllers\Admin\Analy;

use Illuminate\Http\Request;

trait AnalyTraitCalendarnutri
{
    public function calendarnutri(\Illuminate\Http\Request $request) : \Illuminate\View\View
    {
        $NAME_START = "startdate";
        $NAME_END = "enddate";
        $srch = $this->calendarnutri_srch($request, $NAME_START, $NAME_END);

        // servedateを補完しつつ、servedate x timingの連想配列を構成
        $period = \Carbon\CarbonPeriod::create($srch[$NAME_START], $srch[$NAME_END])->toArray();

        $nutris = $this->calendarnutri_nutris();
        $rows = $this->calendarnutri_initdata($nutris, $period);
        $raws = $this->calendarnutri_load($srch, $NAME_START, $NAME_END);
        $rows = $this->calendarnutri_make($raws, $rows);

        return view("admin.analy.calendarnutri.main", compact(["rows", "srch", "period", "nutris", "NAME_START", "NAME_END"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function calendarnutri_srch(\Illuminate\Http\Request $request, string $NAME_START, string $NAME_END) : array
    {
        $range = intval(config("myconf.nutrioffset"));
        $srch = [
            $NAME_START => $request->query($NAME_START, \Carbon\Carbon::today()->addDays(intval($range * -1))->format("Y-m-d")),
            $NAME_END => $request->query($NAME_END, \Carbon\Carbon::today()->addDays(intval($range * 1))->format("Y-m-d")),
        ];
        return $srch;
    }

    private function calendarnutri_nutris() : array
    {
        $q = \App\Models\Nutri::query();
        $q->select([
            "nutri.id AS id",
            "nutri.name AS name",
        ]);
        $q->orderBy("nutri.pos", "ASC");
        $raws = $q->get();
        $ret = [];
        foreach($raws as $raw) {
            $raw["foods"] = $this->calendarnutri_foods($raw->id);
            $ret[$raw->id] = $raw;
        }
        return $ret;
    }

    private function calendarnutri_foods(int $nutri_id) : \Illuminate\Support\Collection
    {
        $q = \App\Models\Foodnutri::query();
        $q->join("food", "food.id", "=", "foodnutri.food_id");
        $q->where("foodnutri.nutri_id", "=", $nutri_id);
        $q->orderBy("favorite", "ASC");
        $q->orderBy("category", "ASC");
        $q->select([
            "food.id AS id",
            "food.name AS name",
        ]);
        $raws = $q->get();
        return $raws;
    }

    private function calendarnutri_initdata(array $nutris , array $period): array
    {
        $ret = [];
        foreach ($nutris as $nutri) {
            $row = [];
            foreach ($period as $perioddate) {
                $str_perioddate = $perioddate->format("Y-m-d");
                $row[$str_perioddate] = 0;
            }
            $ret[$nutri->id] = $row;
        }
        return $ret;
    }

    private function calendarnutri_load(array $srch, string $NAME_START, string $NAME_END) : \Illuminate\Support\Collection
    {
        $q = \App\Models\Menufood::query();
        $q->join("menu", "menu.id", "=", "menufood.menu_id");
        $q->rightJoin("foodnutri", "foodnutri.food_id", "=", "menufood.food_id");
        $q->select([
            "foodnutri.nutri_id AS nutri_id",
            "menu.servedate AS servedate",
        ]);
        $q->whereBetween("menu.servedate", [$srch[$NAME_START], $srch[$NAME_END]]);
        $q->orderBy("menu.servedate", "ASC");
        $raws = $q->get();
        return $raws;
    }

    private function calendarnutri_make(\Illuminate\Support\Collection $raws, array $rows) : array
    {
        foreach ($raws as $raw) {
            $nutri_id = $raw->nutri_id;
            $servedate = $raw->servedate;
            $rows[$nutri_id][$servedate]++;
        }
        return $rows;
    }
}
