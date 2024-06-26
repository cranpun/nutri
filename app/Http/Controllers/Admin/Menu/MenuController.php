<?php

namespace App\Http\Controllers\Admin\Menu;

class MenuController extends \App\Http\Controllers\Controller
{

    // *********************************************************
    // utils
    // *********************************************************

    // *********************************************************
    // action
    // *********************************************************
    use \App\Http\Controllers\Admin\Menu\MenuTraitDelete;
    use \App\Http\Controllers\Admin\Menu\MenuTraitIndex; // swap, updateでindexのメソッドを使うのでそれより上にすること。
    use \App\Http\Controllers\Admin\Menu\MenuTraitMovestore;
    use \App\Http\Controllers\Admin\Menu\MenuTraitUpdate;
    use \App\Http\Controllers\Admin\Menu\MenuTraitUpdatestore;
    use \App\Http\Controllers\Admin\Menu\MenuTraitSwapstore;
    use \App\Http\Controllers\Admin\Menu\MenuTraitDeflunchstore;
}
