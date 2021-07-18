<?php
namespace App\Http\Controllers\Admin\Menu;

use Illuminate\Http\Request;

trait MenuTraitCreatestore
{
    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->all();
        $id = array_key_exists("id", $data) ? $data["id"] : null;

        if($id) {
            // update
            $row = \App\Models\Menu::where("id", "=", $id)->first();
            // ユーザ名が同じであればuniqueは外す
            $val = \App\Models\Menu::$VRULES;
            if($row["name"] == $data["name"]) {
                $val["name"] = "required";
            }
            unset($val["password"]); // updateのときはpasswordとroleのチェックは不要
            unset($val["role"]);
            $request->validate($val);
        } else {
            $row = new \App\Models\Menu();
            $data = $request->all();
            $data["role"] = \App\L\Role::ID_ADMIN; // roleは固定
            \Validator::make($data, \App\Models\Menu::validaterule())->validate();
        }
        if(!$row->saveProc($data)) {
            // 保存失敗
            \U::invokeErrorValidate($request, "更新に失敗しました。");
        }
        return redirect()->route("admin-Menu-index")->with("message-success", "更新しました。");
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
}