<?php

namespace App\Http\Controllers\Admin\Menu;

class MenuController extends \App\Http\Controllers\Controller
{

    // *********************************************************
    // utils
    // *********************************************************
    public static function swapdate(string $date1, string $date2, string $timing) : void {
        $menu_ids = [
            $date1 => [],
            $date2 => [],
        ];
        foreach(array_keys($menu_ids) as $servedate) {
            $q = \App\Models\Menu::query();
            $q->where("menu.servedate", "=", $servedate);
            $q->where("menu.timing", "=", $timing);
            $rows = $q->get()->toArray();
            $menu_ids[$servedate] = array_column($rows, "id");
        }

        // 対応する日付を入れ替えて保存
        $swap_ids = [
            $date2 => $menu_ids[$date1],
            $date1 => $menu_ids[$date2],
        ];
        foreach($swap_ids as $servedate => $ids) {
            $q = \App\Models\Menu::query();
            $q->whereIn("id", $ids);
            $q->update(compact(["servedate"]));
        }
    }

    // *********************************************************
    // action
    // *********************************************************
    use \App\Http\Controllers\Admin\Menu\MenuTraitDelete;
    use \App\Http\Controllers\Admin\Menu\MenuTraitIndex; // swap, updateでindexのメソッドを使うのでそれより上にすること。
    use \App\Http\Controllers\Admin\Menu\MenuTraitMovestore;
    use \App\Http\Controllers\Admin\Menu\MenuTraitUpdate;
    use \App\Http\Controllers\Admin\Menu\MenuTraitUpdatestore;
    use \App\Http\Controllers\Admin\Menu\MenuTraitSwapstore;
    use \App\Http\Controllers\Admin\Menu\MenuTraitDeflunchstore;
}
