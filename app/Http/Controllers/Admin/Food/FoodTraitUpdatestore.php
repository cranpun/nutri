<?php

namespace App\Http\Controllers\Admin\Food;

use Illuminate\Http\Request;

trait FoodTraitUpdatestore
{
    public function updatestore(\Illuminate\Http\Request $request, $food_id)
    {
        // 複数回の変更があるためtransaction
        $trans = \DB::transaction(function () use ($request, $food_id) {
            $data = $request->all();
            $name = array_key_exists("name", $data) ? $data["name"] : null;
            $nutri_ids = array_key_exists("nutri_ids", $data) ? $data["nutri_ids"] : null;

            // 一旦栄養素を全て削除。
            if(\App\Models\Foodnutri::where("food_id", "=", $food_id)->delete() === false) {
                \U::invokeErrorValidate($request, "保存に失敗しました。");
            }

            // 栄養素がポストされていれば保存
            if ($nutri_ids && count($nutri_ids) > 0) {
                if(!$this->updatestore_storeFoodnutri($request, $food_id, $nutri_ids)) {
                    \U::invokeErrorValidate($request, "保存に失敗しました。");
                }
            }

            // 入力値の検証
            $data["favorite"] = array_key_exists("favorite", $data) ? 0 : 100; // チェックボックス送信なのでデータがない場合あり。favoriteは100固定。
            $val = \App\Models\Food::validaterule();
            \Validator::make($data, $val)->validate();

            $row = \App\Models\Food::where("id", "=", $food_id)->first();
            $row->name = $name;
            $row->category = $data["category"];
            $row->favorite = $data["favorite"];

            // 食材の保存
            if (!$row->save()) {
                // 保存失敗
                \U::invokeErrorValidate($request, "保存に失敗しました。");
            }

            // 全部正常
            return true;
        });

        if ($trans) {
            return redirect()->route("admin-food-index")->with("message-success", "更新しました。");
        } else {
            \U::invokeErrorValidate($request, "保存に失敗しました。{$trans->message()}");
        }
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function updatestore_storeFoodnutri($request, $food_id, $nutri_ids) : bool
    {
        $amount = 0;  // 未使用なので自動設定。
        foreach ($nutri_ids as $nutri_id => $on) {
            $val = \App\Models\Foodnutri::validaterule();
            $validator = \Validator::make(compact(["food_id", "nutri_id", "amount"]), $val)->validate();

            $ent = new \App\Models\Foodnutri();
            $ent->food_id = $food_id;
            $ent->nutri_id = $nutri_id;
            $ent->amount = $amount;

            if (!$ent->save()) {
                \U::invokeErrorValidate($request, "保存に失敗しました。");
            }
        }

        // 全部正常に保存
        return true;
    }
}
