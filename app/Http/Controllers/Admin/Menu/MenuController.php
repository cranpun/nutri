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
    use \App\Http\Controllers\Admin\Menu\MenuTraitIndex; // swapでindexのメソッドを使うのでswapより上にすること。
    use \App\Http\Controllers\Admin\Menu\MenuTraitUpdate;
    use \App\Http\Controllers\Admin\Menu\MenuTraitUpdatestore;
    use \App\Http\Controllers\Admin\Menu\MenuTraitSwapstore;
}
