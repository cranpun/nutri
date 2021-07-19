<?php
namespace App\Http\Controllers\Admin\Menu;

use Illuminate\Http\Request;

trait MenuTraitDelete
{
    public function delete(Request $request, $Menu_id)
    {
        $row = \App\Models\Menu::find($Menu_id);

        // ユーザ削除はactiveをoffに。
        if(!$row->delete()) {
            // 保存失敗
            \U::invokeErrorValidate($request, "削除に失敗しました。");
        }
        // それぞれのroleに応じた一覧へ移動。
        return redirect()->route("admin-Menu-index")->with("message-success", "削除しました。");
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
}