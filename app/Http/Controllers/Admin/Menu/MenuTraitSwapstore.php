<?php

namespace App\Http\Controllers\Admin\Menu;

use Illuminate\Http\Request;

trait MenuTraitSwapstore
{
    public function swapstore(\Illuminate\Http\Request $request, $servedate, $timing, $dir)
    {
        // 複数回の変更があるためtransaction
        $trans = \DB::transaction(function () use ($request, $servedate, $timing, $dir) {
            $swapdate = $this->swapstore_dirdate($servedate, $dir);

            $serveids = $this->swapstore_loadids($servedate, $timing);
            $swapids = $this->swapstore_loadids($swapdate, $timing);

            // idを指定して日付を入れ替え
            $this->swapstore_swap($servedate, $swapids);
            $this->swapstore_swap($swapdate, $serveids);

            return true;
        });

        if ($trans) {
            $srch = $this->index_srch($request); // ※indexの関数。trait外呼び出しなので注意。
            return redirect()->route("admin-menu-index", $srch)->with("message-success", "更新しました。");
        } else {
            \U::invokeErrorValidate($request, "保存に失敗しました。{$trans->message()}");
        }
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function swapstore_dirdate($servedate, $dir)
    {
        if ($dir == "up") {
            // 次の日とswap
            return \Carbon\Carbon::parse($servedate)->addDay(1)->format("Y-m-d");
        } else /* if($dir == "down") */ {
            // 前の日とswap
            return \Carbon\Carbon::parse($servedate)->addDay(-1)->format("Y-m-d");
        }
    }

    private function swapstore_loadids($servedate, $timing)
    {
        $q = \App\Models\Menu::query();
        $q->where("servedate", "=", $servedate);
        $q->where("timing", "=", $timing);
        $rows = $q->get()->toArray();
        $ret = array_column($rows, "id");
        return $ret;
    }

    private function swapstore_swap($servedate, $ids)
    {
        $q = \App\Models\Menu::query();
        $q->whereIn("id", $ids);
        $q->update(compact(["servedate"]));
    }
}
