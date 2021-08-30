<?php
namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;

trait UserTraitChangepassword
{
    public function changepassword(Request $request, string $user_id) : \Illuminate\Http\RedirectResponse
    {
        $user = \Auth::user();
        $validate = [
            "password"=> "required|min:8"
        ];
        try {
            $request->validate($validate);
        }catch(\Exception $e) {
            \U::invokeErrorValidate($request, "ご利用できないパスワードです。");
        }

        $password = $request->input("password");
        $row = \App\Models\User::where("id", "=", $user_id)->get()->toArray()[0];
        if(!$row->saveProc(["password" => $password])) {
            // 保存失敗
            \U::invokeErrorValidate($request, "保存に失敗しました。");
        }

        return redirect()->route("admin-user-index")->with("message-success", "保存しました。");
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
}
