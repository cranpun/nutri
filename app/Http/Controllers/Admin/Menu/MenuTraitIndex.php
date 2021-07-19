<?php
namespace App\Http\Controllers\Admin\Menu;

use Illuminate\Http\Request;

trait MenuTraitIndex
{
    public function index(Request $request)
    {
        $q = \App\Models\Menu::query();
        $q->select([
            "menu.id AS id",
            "menu.name AS name",
            "menu.servedate AS servedate",
            "menu.timing AS timing",
        ]);
        $q->orderBy("menu.servedate", "ASC");
        $q->orderBy("menu.timing", "ASC");
        $raws = $q->get();
        $rows = $this->index_make($raws);
        $timing = (new \App\L\MenuTiming())->labelObjs();
        return view("admin.menu.index.main", compact(["rows", "timing"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************

    private function index_make($rows)
    {
        // servedateを補完しつつ、servedate x timingの連想配列を構成
        // MYTODO 日付範囲。まずは前後1週間
        $start = \Carbon\Carbon::today();
        $start->addDay(-5);
        $end = \Carbon\Carbon::today();
        $end->addDay(5);
        $period = \Carbon\CarbonPeriod::create($start, $end);

        $idx = 0;
        $ret = [];
        foreach($period as $perioddate) {
            // この日のデータを初期化
            $str_perioddate = $perioddate->format("Y-m-d");
            $ret[$str_perioddate] = [
                \App\L\MenuTiming::ID_LUNCH => [],
                \App\L\MenuTiming::ID_DINNER => [],
            ];

            // もうロードデータがなければ次へ。
            if(count($rows) <= $idx) {
                continue;
            }

            $str_perioddate = $perioddate->format("Y-m-d");

            while($str_perioddate == $rows[$idx]->servedate) {
                // この日のデータ
                $ret[$str_perioddate][$rows[$idx]->timing][] = $rows[$idx];

                // 次のロードデータへ。
                $idx++;
                if(count($rows) <= $idx) {
                    // データがなければおしまい。
                    break;
                }
            }
        }
        return $ret;
    }
}