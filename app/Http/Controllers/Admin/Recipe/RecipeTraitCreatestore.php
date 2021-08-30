<?php
namespace App\Http\Controllers\Admin\Recipe;

use Illuminate\Http\Request;

trait RecipeTraitCreatestore
{
    public function createstore(\Illuminate\Http\Request $request) : \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();

        $row = new \App\Models\Recipe();
        $data = $request->all();
        $val = \App\Models\Recipe::validaterule();
        \Validator::make($data, $val)->validate();

        $row->name = $data["name"];
        $row->category = $data["category"];
        $row->url = $data["url"];
        // $row->memo = $data["memo"];

        if(!$row->save()) {
            // 保存失敗
            \U::invokeErrorValidate($request, "更新に失敗しました。");
        }
        return redirect()->route("admin-recipe-index")->with("message-success", "更新しました。");
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
}
