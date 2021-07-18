<?php
namespace App\Http\Controllers\Admin\Menu;

trait MenuTraitUpdate
{
    public function update(\Illuminate\Http\Request $request, $servedate)
    {
        $menumax = 5;
        $rows = $this->update_loadMenus($servedate, $menumax);
        return view("admin.menu.update.main", compact(["rows", "servedate"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function update_loadMenus($servedate, $menumax)
    {
        // 昼食と夕食
        $q = \App\Models\Menu::query();
        $q->where("menu.servedate", "=", $servedate);
        $q->select([
            "menu.name AS name",
        ]);

        $timings = [
            \App\L\MenuTiming::ID_LUNCH,
            \App\L\MenuTiming::ID_DINNER
        ];
        $ret = [];
        foreach($timings as $timing) {
            $tq = clone $q;
            $rows = $tq->get();

            // 最大数まで補完
            for($i = 0; $i < $menumax; $i++) {
                $ret[$timing][] = count($rows) > $i ? $rows[$i] : ["name" => ""];
            }
        }
        return $ret;
    }
}