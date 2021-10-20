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

            $serveids = $this->swapstore_loadids($servedate, $timing);
            $swapids = $this->swapstore_loadids($swapdate, $timing);

            // idを指定して日付を入れ替え
            $this->swapstore_swap($servedate, $swapids);
            $this->swapstore_swap($swapdate, $serveids);

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

    private function swapstore_loadids(string $servedate, string $timing) : array
    {
        $q = \App\Models\Menu::query();
        $q->where("servedate", "=", $servedate);
        $q->where("timing", "=", $timing);
        $rows = $q->get()->toArray();
        $ret = array_column($rows, "id");
        return $ret;
    }

    private function swapstore_swap(string $servedate, array $ids) : void
    {
        $q = \App\Models\Menu::query();
        $q->whereIn("id", $ids);
        $q->update(compact(["servedate"]));
    }
}
