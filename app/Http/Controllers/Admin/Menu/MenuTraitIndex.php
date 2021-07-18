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
        return view("admin.menu.index.main", compact(["rows"]));
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

            // 現在のperiodがロードデータより古ければ
            $idxdate = $rows[$idx]->servedate;
            $cidxdate = \Carbon\Carbon::parse($idxdate);
            $cperioddate = \Carbon\Carbon::parse($perioddate);

            while($cperioddate->eq($cidxdate)) {
                // この日のデータ
                $ret[$perioddate][$rows[$idx]->timing] = $rows[$idx];

                // 次のロードデータへ。
                $idx++;
                if(count($rows) <= $idx) {
                    // データがなければおしまい。
                    break;
                }

                $idxdate = $rows[$idx]->servedate;
                $cidxdate = \Carbon\Carbon::parse($idxdate);
            }
        }
        return $ret;
    }
}