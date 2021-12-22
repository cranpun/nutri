<?php

namespace App\Http\Controllers\Admin\Recipe;

use Illuminate\Http\Request;

trait RecipeTraitUpdatestore
{
    public function updatestore(\Illuminate\Http\Request $request, string $recipe_id) : ?\Illuminate\Http\RedirectResponse
    {
        // 複数回の変更があるためtransaction
        $trans = \DB::transaction(function () use ($request, $recipe_id) {
            $data = $request->all();

            // 入力値の検証
            $val = \App\Models\Recipe::validaterule();
            \Validator::make($data, $val)->validate();

            $row = \App\Models\Recipe::where("id", "=", $recipe_id)->first();
            $row->name = $data["name"];
            $row->category = $data["category"];
            $row->url = $data["url"];
            $row->memo = $data["memo"];

            // 食材の保存
            if (!$row->save()) {
                // 保存失敗
                \U::invokeErrorValidate($request, "保存に失敗しました。");
            }

            // 全部正常
            return true;
        });

        if ($trans) {
            return redirect()->route("admin-recipe-index")->with("message-success", "更新しました。");
        } else {
            \U::invokeErrorValidate($request, "保存に失敗しました。");
            return null;
        }
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
}
