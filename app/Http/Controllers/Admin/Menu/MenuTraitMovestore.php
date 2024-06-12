<?php

namespace App\Http\Controllers\Admin\Menu;

trait MenuTraitMovestore
{
    public function movestore(\Illuminate\Http\Request $request, string $servedate, string $timing)
    {
        $movedate = $request->input("movedate", $servedate);
        $rows = $this->movestore_loadMenus($servedate, $timing);

        // 複数回の変更があるためtransaction
        $trans = \DB::transaction(function () use ($rows, $movedate) {
            foreach($rows as $row) {
                $row->servedate = $movedate;
                $row->save();
            }

            return true;
        });

        if ($trans) {
            $cnt = count($rows);
            return redirect()->to(route("admin-menu-index") . "#row-{$movedate}")->with("message-success", "{$movedate}に{$cnt}個、移動しました。");
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
