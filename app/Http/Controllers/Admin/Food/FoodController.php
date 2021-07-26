<?php

namespace App\Http\Controllers\Admin\Food;

class FoodController extends \App\Http\Controllers\Controller
{

    // *********************************************************
    // utils
    // *********************************************************

    // *********************************************************
    // action
    // *********************************************************
    use \App\Http\Controllers\Admin\Food\FoodTraitCreatestore;
    use \App\Http\Controllers\Admin\Food\FoodTraitDelete;
    use \App\Http\Controllers\Admin\Food\FoodTraitIndex;
    use \App\Http\Controllers\Admin\Food\FoodTraitUpdate;
    use \App\Http\Controllers\Admin\Food\FoodTraitUpdatestore;
    use \App\Http\Controllers\Admin\Food\FoodTraitShoppingnote;
}
