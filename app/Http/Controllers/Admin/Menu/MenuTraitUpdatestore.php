<?php

namespace App\Http\Controllers\Admin\Menu;

use App\U\DBResult;
use Illuminate\Http\Request;

trait MenuTraitUpdatestore
{
    public function updatestore(\Illuminate\Http\Request $request, $menu_id)
    {
        // 複数回の変更があるためtransaction
        $trans = \DB::transaction(function () use ($request, $menu_id) {
            $data = $request->all();
            $name = array_key_exists("name", $data) ? $data["name"] : null;
            $nutri_ids = array_key_exists("nutri_ids", $data) ? $data["nutri_ids"] : null;

            // 一旦栄養素を全て削除。
            if(\App\Models\Menunutri::where("menu_id", "=", $menu_id)->delete()) {
                return new \App\U\DBResult(false, "以前の栄養素関連付けのクリアに失敗しました。");
            }

            // 栄養素がポストされていれば保存
            if ($nutri_ids && count($nutri_ids) > 0) {
                $resfn = $this->updatestore_storeMenunutri($request, $menu_id, $nutri_ids);
                if($resfn->error()) {
                    return $resfn;
                }
            }

            // 入力値の検証
            $data["amount"] = 0; // amountは未使用なので自動設定。
            $val = \App\Models\Menu::validaterule();
            \Validator::make($data, $val)->validate();

            $row = \App\Models\Menu::where("id", "=", $menu_id)->first();
            $row->name = $name;

            // 食材の保存
            if (!$row->save()) {
                // 保存失敗
                return new \App\U\DBResult(false, "食材データの保存に失敗しました。");
            }

            // 全部正常
            return new \App\U\DBResult(true, "");
        });

        if ($trans->success()) {
            return redirect()->route("admin-menu-index")->with("message-success", "更新しました。");
        } else {
            \U::invokeErrorValidate($request, "保存に失敗しました。{$trans->message()}");
        }
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function updatestore_storeMenunutri($request, $menu_id, $nutri_ids) : \App\U\DBResult
    {
        foreach ($nutri_ids as $nutri_id) {
            $ent = new \App\Models\Menunutri();
            $ent->menu_id = $menu_id;
            $ent->nutri_id = $nutri_id;
            $ent->amount = 0; // 未使用なので自動設定。

            $val = \App\Models\Menunutri::validaterule();
            \Validator::make($ent, $val)->validate();
            if (!$ent->save()) {
                return new \App\U\DBResult(false, "栄養素との関連付けに失敗しました。");
            }
        }

        // 全部正常に保存
        return new \App\U\DBResult(true, "");

    }
}
