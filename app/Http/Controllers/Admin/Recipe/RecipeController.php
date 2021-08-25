<?php

namespace App\Http\Controllers\Admin\Recipe;

class RecipeController extends \App\Http\Controllers\Controller
{

    // *********************************************************
    // utils
    // *********************************************************

    // *********************************************************
    // action
    // *********************************************************
    use \App\Http\Controllers\Admin\Recipe\RecipeTraitCreatestore;
    use \App\Http\Controllers\Admin\Recipe\RecipeTraitDelete;
    use \App\Http\Controllers\Admin\Recipe\RecipeTraitIndex;
    use \App\Http\Controllers\Admin\Recipe\RecipeTraitUpdate;
    use \App\Http\Controllers\Admin\Recipe\RecipeTraitUpdatestore;
}
