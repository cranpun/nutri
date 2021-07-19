<?php

namespace App\Http\Controllers\Admin\Menu;

trait MenuTraitUpdate
{
    public function update(\Illuminate\Http\Request $request, $servedate, $timing)
    {
        $menumax = 5;
        $rows = $this->update_loadMenus($servedate, $timing, $menumax);
        return view("admin.menu.update.main", compact(["rows", "servedate", "timing"]));
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
            "menu.name AS name",
        ]);
        $raws = $q->get();

        // 最大数まで補完
        for ($i = 0; $i < $menumax; $i++) {
            $ret[$timing][] = count($raws) > $i ? $raws[$i] : ["name" => ""];
        }

        return $ret;
    }
}
