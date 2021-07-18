<?php
namespace App\Http\Controllers\Admin\Menu;

use Illuminate\Http\Request;

trait MenuTraitIndex
{
    public function index(Request $request)
    {
        $q = \App\Models\Menu::query();
        $q->select([
            "menu.id AS id",
            "menu.name AS name",
            "menu.favorite AS favorite",
            "menu.category AS category",
        ]);
        $q->orderBy("menu.favorite", "ASC");
        $q->orderBy("menu.category", "ASC");
        $raws = $q->get();
        $rows = $this->index_make($raws);
        return view("admin.menu.index.main", compact(["rows"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************

    private function index_make($rows)
    {
        $ret = [];
        foreach($rows as $row) {
            $row["nutri"] = $this->index_loadNutri($row->id);
            $row["bgcolor"] = $this->index_favoritecolor($row->favorite);
            $ret[] = $row;
        }
        return $ret;
    }

    private function index_loadNutri($menu_id)
    {
        $q = \App\Models\Menunutri::query();
        $q->join("nutri", "nutri.id", "menunutri.nutri_id");
        $q->where("menunutri.menu_id", "=", $menu_id);
        $q->orderBy("nutri.pos", "ASC");
        $q->select([
            "nutri.id AS id",
            "nutri.name AS name",
        ]);
        $rows = $q->get();

        $ret = [];
        foreach($rows as $row) {
            $ret[$row->id] = $row->name;
        }
        return $ret;
    }

    private function index_favoritecolor($fav) 
    {
        $colors = [
            0 => "has-background-primary-light",
        ];
        if(array_key_exists($fav, $colors)) {
            return $colors[$fav];
        } else {
            return "";
        }
    }
}