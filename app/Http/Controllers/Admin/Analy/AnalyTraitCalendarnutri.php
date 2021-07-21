<?php

namespace App\Http\Controllers\Admin\Analy;

use Illuminate\Http\Request;

trait AnalyTraitCalendarnutri
{
    public function calendarnutri(\Illuminate\Http\Request $request)
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
    private function calendarnutri_srch($request, $NAME_START, $NAME_END)
    {
        $range = config("myconf.nutrioffset");
        $srch = [
            $NAME_START => $request->query($NAME_START, \Carbon\Carbon::today()->addDay($range * -1)->format("Y-m-d")),
            $NAME_END => $request->query($NAME_END, \Carbon\Carbon::today()->addDay($range * 1)->format("Y-m-d")),
        ];
        return $srch;
    }

    private function calendarnutri_nutris()
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
            $ret[$raw->id] = $raw;
        }
        return $ret;
    }

    private function calendarnutri_initdata($nutris, $period)
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

    private function calendarnutri_load($srch, $NAME_START, $NAME_END)
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

    private function calendarnutri_make($raws, $rows)
    {
        foreach ($raws as $raw) {
            $nutri_id = $raw->nutri_id;
            $servedate = $raw->servedate;
            $rows[$nutri_id][$servedate]++;
        }
        return $rows;
    }
}
