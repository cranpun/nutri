<?php

namespace App\L;

class RecipeCategory extends ZzzLabel
{
    const ID_JPMAIN = "jpmain";
    const ID_JPSUB = "jpsub";
    const ID_JPSTP = "jpstp";
    const ID_EUROMAIN = "euromain";
    const ID_EUROSUB = "eurosub";
    const ID_EUROSTP = "eurostp";
    const ID_CHMAIN = "chmain";
    const ID_CHSUB = "chsub";
    const ID_CHSTP = "chstp";
    const ID_SWEETS = "sweets";
    const ID_ETC = "etc";

    public function labels() : array
    {
        return [
            self::ID_JPMAIN => "和食：主菜",
            self::ID_JPSUB => "和食：副菜",
            self::ID_JPSTP => "和食：主食",
            self::ID_EUROMAIN => "洋食：主菜",
            self::ID_EUROSUB => "洋食：副菜",
            self::ID_EUROSTP => "洋食：主食",
            self::ID_CHMAIN => "中華：主菜",
            self::ID_CHSUB => "中華：副菜",
            self::ID_CHSTP => "中華：主食",
            self::ID_SWEETS => "お菓子",
            self::ID_ETC => "その他",
        ];
    }
}
