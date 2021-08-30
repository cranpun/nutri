<?php
namespace App\Http\Controllers\Pub\User;

trait UserTraitAuthenticate
{
    public function authenticate(\Illuminate\Http\Request $request) : ?\Illuminate\Http\RedirectResponse
    {
        $credentials = $request->only("name", "password");
        $res = \Auth::attempt($credentials);
        $data = $request->all();
        if($res) {
            // activeの確認
            $user = \App\Models\User::where("name", "=", $data["name"])->first();

            // ログイン成功
            return redirect()->intended(route("top"));
        } else {
            // ログイン失敗のため、強制的にバリデーションエラーを発生。
            \U::invokeErrorValidate($request, "ログインに失敗しました。");
            return null;
        }
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
}