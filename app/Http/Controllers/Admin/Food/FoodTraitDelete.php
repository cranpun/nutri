<?php
namespace App\Http\Controllers\Admin\Food;

use Illuminate\Http\Request;

trait FoodTraitDelete
{
    public function delete(Request $request, string $food_id) : ?\Illuminate\Http\RedirectResponse
    {
        $row = \App\Models\Food::find($food_id) ?? null;

        if($row) {
            \App\Models\Foodnutri::where("food_id", "=", $food_id)->delete();

            // ユーザ削除はactiveをoffに。
            if(!$row->delete()) {
                // 保存失敗
                \U::invokeErrorValidate($request, "削除に失敗しました。");
            }
            // それぞれのroleに応じた一覧へ移動。
            return redirect()->route("admin-food-index")->with("message-success", "削除しました。");
        }
        return null;
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
}