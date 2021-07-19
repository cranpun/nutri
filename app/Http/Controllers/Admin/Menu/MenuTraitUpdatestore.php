<?php

namespace App\Http\Controllers\Admin\Menu;

use Illuminate\Http\Request;

trait MenuTraitUpdatestore
{
    public function updatestore(\Illuminate\Http\Request $request, $servedate, $timing)
    {
        // 複数回の変更があるためtransaction
        $trans = \DB::transaction(function () use ($request, $servedate, $timing) {
            $data = $request->all();
            $names = array_key_exists("name", $data) ? $data["name"] : [];
            $food_ids = array_key_exists("food_id", $data) ? $data["food_id"] : [];

            // 日付とタイミングの検証
            $val = \App\Models\Menu::validaterule();
            $val_common = [
                "servedate" => $val["servedate"],
                "timing" => $val["timing"]
            ];
            \Validator::make(compact(["servedate", "timing"]), $val_common)->validate();

            $menu_ids = $this->updatestore_procMenu($servedate, $timing, $names);
            $this->updatestore_procMenufood($menu_ids, $food_ids);

            return true;
        });

        if ($trans) {
            return redirect()->route("admin-menu-index")->with("message-success", "更新しました。");
        } else {
            \U::invokeErrorValidate($request, "保存に失敗しました。{$trans->message()}");
        }
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function updatestore_procMenu($servedate, $timing, $names) : array
    {
        // まずは該当するメニューを保持。menufoodクリアのため。
        $q_old = \App\Models\Menu::query();
        $q_old->where("servedate", "=", $servedate);
        $q_old->where("timing", "=", $timing);
        $rows_old = $q_old->get();
        $oldids = [];
        foreach($rows_old as $row) {
            $oldids[] = $row->id;
        }

        // 新しく保存
        $newids = [];
        $val = \App\Models\Menu::validaterule();
        // servedateとtimingは呼び出し元で検証済み
        $val_now = [
            "name" => $val["name"],
        ];
        foreach($names as $idx => $name) {
            $ent = new \App\Models\Menu();
            // amountは未使用なので0固定。
            \validator::make(["name" => $name, "amount" => 0], $val_now)->validate();
            $ent->name = $name;
            $ent->servedate = $servedate;
            $ent->timing = $timing;
            $ent->save();
            $newids[] = $ent->id;
        }

        return compact(["newids", "oldids"]);
    }

    private function updatestore_procMenufood($menu_ids, $food_ids)
    {
        // MYTODO まずはmenu_ids["oldids"]に従って古いfoodmenuを削除

        // MYTODO 新しいmenu_ids["newids"]に従って新しいfoodmenuを登録。food_idsはuiのidx配列で保存されているのでそれを踏まえること。
    }

    // private function updatestore_storeMenunutri($request, $menu_id, $nutri_ids) : \App\U\DBResult
    // {
    //     foreach ($nutri_ids as $nutri_id) {
    //         $ent = new \App\Models\Menunutri();
    //         $ent->menu_id = $menu_id;
    //         $ent->nutri_id = $nutri_id;
    //         $ent->amount = 0; // 未使用なので自動設定。

    //         $val = \App\Models\Menunutri::validaterule();
    //         \Validator::make($ent, $val)->validate();
    //         if (!$ent->save()) {
    //             return new \App\U\DBResult(false, "栄養素との関連付けに失敗しました。");
    //         }
    //     }

    //     // 全部正常に保存
    //     return new \App\U\DBResult(true, "");
    // }

    // private function updatestore_procMenufood($menu_id)
    // {

    // }
}
