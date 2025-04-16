<?php

namespace App\Http\Controllers\Admin\Menu;

use Illuminate\Http\Request;

trait MenuTraitDeflunchstore
{
    public function deflunchstore(\Illuminate\Http\Request $request) : ?\Illuminate\Http\RedirectResponse
    {
        $sdate = $this->deflunchstore_loadLastlunchdate();

        // 複数回の変更があるためtransaction
        $trans = \DB::transaction(function () use ($request) {
            // 設定すべき月曜日
            $sdate = $this->deflunchstore_loadLastlunchdate();
            $edate = (new \Carbon\Carbon($sdate))->addDays(6)->format("Y-m-d");
            $period = \Carbon\CarbonPeriod::create($sdate, $edate)->toArray();
            $names = [
                "そば",
                "スパ",
                "焼きそば",
                "スパ",
                "そば",
                "スパor自由",
                "焼きそば",
            ];

            foreach($period as $idx => $date) {
                $ent = new \App\Models\Menu();
                $ent->name = $names[$idx];
                $ent->servedate = $date;
                $ent->timing = \App\L\MenuTiming::ID_LUNCH;
                $ent->save();
            }
            return true;
        });

        if ($trans) {
            $srch = $this->index_srch($request); // ※indexの関数。trait外呼び出しなので注意。
            return redirect()->to(route("admin-menu-index", $srch))->with("message-success", "デフォルト昼食をセットしました。");
        } else {
            \U::invokeErrorValidate($request, "保存に失敗しました。");
            return null;
        }
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function deflunchstore_loadLastlunchdate(): string
    {
        $lastq = \App\Models\Menu::query();
        $lastq->where("menu.timing", "=", \App\L\MenuTiming::ID_LUNCH);
        $lastq->orderBy("menu.servedate", "DESC");
        $lastrow = $lastq->first();

        $lastdate = $lastrow->servedate;
        // 最後の日の次の日が含まれる週の月曜日。startOfWeekが日曜日なので+1
        $ret = (new \Carbon\Carbon($lastdate))->addDays(1)->startOfWeek()->addDays(1)->format("Y-m-d");
        return $ret;
    }
}
