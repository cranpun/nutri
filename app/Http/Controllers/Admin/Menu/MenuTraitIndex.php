<?php
namespace App\Http\Controllers\Admin\Menu;

use Illuminate\Http\Request;

trait MenuTraitIndex
{
    public static $index_NAME_EDATE = "edate";
    public static $index_NAME_SDATE = "sdate";
    public function index(Request $request)
    {
        $srch = $this->index_srch($request);
        $rows = $this->index_load($srch);
        $timing = (new \App\L\MenuTiming())->labelObjs();
        return view("admin.menu.index.main", compact(["rows", "timing", "srch"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************

    /**
     * swapでもsrchを積むのでpublic。
     */
    public function index_srch($request)
    {
        $range = config("myconf.nutrioffset");
        $srch = [
            self::$index_NAME_SDATE => $request->query(self::$index_NAME_SDATE, \Carbon\Carbon::today()->addDay($range * -1)->format("Y-m-d")),
            self::$index_NAME_EDATE => $request->query(self::$index_NAME_EDATE, \Carbon\Carbon::today()->addDay($range * 1)->format("Y-m-d")),
        ];
        return $srch;
    }

    private function index_load($srch)
    {
        $q = \App\Models\Menu::query();
        $q->select([
            "menu.id AS id",
            "menu.name AS name",
            "menu.memo AS memo",
            "menu.servedate AS servedate",
            "menu.timing AS timing",
        ]);
        $q->whereBetween("servedate", [$srch[self::$index_NAME_SDATE], $srch[self::$index_NAME_EDATE]]);
        $q->orderBy("menu.servedate", "DESC");
        $q->orderBy("menu.timing", "DESC");
        $raws = $q->get();
        $rows = $this->index_make($raws, $srch);
        return $rows;
    }

    private function index_make($rows, $srch)
    {
        // servedateを補完しつつ、servedate x timingの連想配列を構成
        $period = array_reverse(\Carbon\CarbonPeriod::create($srch[self::$index_NAME_SDATE], $srch[self::$index_NAME_EDATE])->toArray());

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
                $nowrow =  $rows[$idx];
                $nowrow["foods"] = $this->index_loadFood($rows[$idx]["id"]);
                $ret[$str_perioddate][$rows[$idx]->timing][] = $nowrow;

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

    private function index_loadFood($menu_id)
    {
        $q = \App\Models\Menufood::query();
        $q->join("food", "food.id", "=", "menufood.food_id");
        $q->where("menufood.menu_id", "=", $menu_id);
        $q->orderBy("food.favorite", "ASC");
        $q->orderBy("food.category", "ASC");
        $q->select([
            "food.id AS id",
            "food.name AS name",
        ]);
        $rows = $q->get();
        $ret = $rows;
        return $ret;
    }
}
