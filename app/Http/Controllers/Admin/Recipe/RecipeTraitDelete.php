<?php
namespace App\Http\Controllers\Admin\Recipe;

use Illuminate\Http\Request;

trait RecipeTraitDelete
{
    public function delete(Request $request, string $recipe_id) : ?\Illuminate\Http\RedirectResponse
    {
        $row = \App\Models\Recipe::find($recipe_id);

        if($row) {
            // ユーザ削除はactiveをoffに。
            if(!$row->delete()) {
                // 保存失敗
                \U::invokeErrorValidate($request, "削除に失敗しました。");
            }
            // それぞれのroleに応じた一覧へ移動。
            return redirect()->route("admin-recipe-index")->with("message-success", "削除しました。");
        }
        return null;
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
}