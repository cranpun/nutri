<?php

namespace App\Http\Controllers\Admin\Menu;

trait MenuTraitMovestore
{
    public function movestore(\Illuminate\Http\Request $request, string $servedate, string $timing)
    {
        $movedate = $request->input("movedate", $servedate);

        $trans = \DB::transaction(function () use ($servedate, $movedate, $timing) {
            $this->swapdate($servedate, $movedate, $timing);

            return true;
        });

        if ($trans) {
            return redirect()->to(route("admin-menu-index") . "#row-{$movedate}")->with("message-success", "{$servedate}と{$movedate}を入れ替えました。");
        } else {
            \U::invokeErrorValidate($request, "保存に失敗しました。");
            return null;
        }

    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function movestore_loadMenus(string $servedate, string $timing)
    {
        // 昼食と夕食
        $q = \App\Models\Menu::query();
        $q->where("menu.servedate", "=", $servedate);
        $q->where("menu.timing", "=", $timing);
        $ret = $q->get();

        return $ret;
    }
}
