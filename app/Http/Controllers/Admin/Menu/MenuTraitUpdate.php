<?php
namespace App\Http\Controllers\Admin\Menu;

trait MenuTraitUpdate
{
    public function update(\Illuminate\Http\Request $request, $menu_id)
    {
        $row = \App\Models\Menu::where("id", "=", $menu_id)->first();
        $nutris = \App\Models\Nutri::loadAll();
        $menunutris = $this->update_loadNutri($menu_id);
        return view("admin.menu.update.main", compact(["row", "nutris", "menunutris"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function update_loadNutri($menu_id)
    {
        $q = \App\Models\Menunutri::query();
        $q->where("menunutri.menu_id", "=", $menu_id);
        $q->select([
            "menunutri.nutri_id AS id",
        ]);
        $rows = $q->get();

        $ret = [];
        foreach($rows as $row) {
            $ret[] = $row->id;
        }
        return $ret;
    }
}