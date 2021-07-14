<?php
namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;

trait UserTraitDelete
{
    public function delete(Request $request, $user_id)
    {
        $row = \App\Models\User::find($user_id);

        // ユーザ削除はactiveをoffに。
        if(!$row->delete()) {
            // 保存失敗
            \U::invokeErrorValidate($request, "削除に失敗しました。");
        }
        // それぞれのroleに応じた一覧へ移動。
        return redirect()->route("admin-user-index")->with("message-success", "削除しました。");
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
}