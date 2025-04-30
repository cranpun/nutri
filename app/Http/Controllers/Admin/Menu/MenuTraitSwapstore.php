<?php

namespace App\Http\Controllers\Admin\Menu;

use Illuminate\Http\Request;

trait MenuTraitSwapstore
{
    public function swapstore(\Illuminate\Http\Request $request, string $servedate, string $timing, string $dir) : ?\Illuminate\Http\RedirectResponse
    {
        // 複数回の変更があるためtransaction
        $swapdate = $this->swapstore_dirdate($servedate, $dir);
        $trans = \DB::transaction(function () use ($servedate, $timing, $swapdate) {
            $this->swapdate($servedate, $swapdate, $timing);
            return true;
        });

        if ($trans) {
            $srch = $this->index_srch($request); // ※indexの関数。trait外呼び出しなので注意。
            $ankerdate = strtotime($servedate) > strtotime($swapdate) ? $servedate : $swapdate; // 上の日付
            return redirect()->to(route("admin-menu-index", $srch) . "#row-{$ankerdate}")->with("message-success", "更新しました。");
        } else {
            \U::invokeErrorValidate($request, "保存に失敗しました。");
            return null;
        }
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function swapstore_dirdate(string $servedate, string $dir) : string
    {
        if ($dir == "next") {
            // 次の日とswap
            return \Carbon\Carbon::parse($servedate)->addDays(1)->format("Y-m-d");
        } else /* if($dir == "down") */ {
            // 前の日とswap
            return \Carbon\Carbon::parse($servedate)->addDays(-1)->format("Y-m-d");
        }
    }
}
