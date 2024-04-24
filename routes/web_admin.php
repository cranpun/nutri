<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\User\UserController;
use \App\Http\Controllers\Admin\Food\FoodController;
use \App\Http\Controllers\Admin\Menu\MenuController;
use \App\Http\Controllers\Admin\Recipe\RecipeController;
use \App\Http\Controllers\Admin\Analy\AnalyController;

Route::middleware(["can:admin","auth"])->group(function () {
    Route::get("/", [MenuController::class, "index"])->name("top"); // MYTODO 生徒一覧ができればそれに変更。

    // **************************************************************
    // user
    // **************************************************************
    Route::post("/user/createstore", [UserController::class, "createstore"])->name("admin-user-createstore");
    Route::post("/user/delete/{user_id}", [UserController::class, "delete"])->name("admin-user-delete");
    Route::post("/user/changepassword/{user_id}", [UserController::class, "changepassword"])->name("admin-user-changepassword");
    Route::post("/user/overwritepassword/{user_id}", [UserController::class, "overwritepassword"])->name("admin-user-overwritepassword");
    Route::get("/user/index", [UserController::class, "index"])->name("admin-user-index");
    Route::get("/user/update/{user_id}", [UserController::class, "update"])->name("admin-user-update");
    Route::post("/user/updatestore", [UserController::class, "updatestore"])->name("admin-user-updatestore");

    // **************************************************************
    // food
    // **************************************************************
    Route::post("/food/createstore", [FoodController::class, "createstore"])->name("admin-food-createstore");
    Route::post("/food/delete/{food_id}", [FoodController::class, "delete"])->name("admin-food-delete");
    Route::get("/food/index", [FoodController::class, "index"])->name("admin-food-index");
    Route::get("/food/update/{food_id}", [FoodController::class, "update"])->name("admin-food-update");
    Route::get("/food/detail/{food_id}", [FoodController::class, "detail"])->name("admin-food-detail");
    Route::post("/food/updatestore/{food_id}", [FoodController::class, "updatestore"])->name("admin-food-updatestore");
    Route::get("/food/shoppingnote", [FoodController::class, "shoppingnote"])->name("admin-food-shoppingnote");

    // **************************************************************
    // menu
    // **************************************************************
    Route::post("/menu/createstore/{servedate}", [MenuController::class, "createstore"])->name("admin-menu-createstore");
    Route::post("/menu/delete/{menu_id}", [MenuController::class, "delete"])->name("admin-menu-delete");
    Route::get("/menu/index", [MenuController::class, "index"])->name("admin-menu-index");
    Route::get("/menu/update/{servedate}/{timing}", [MenuController::class, "update"])->name("admin-menu-update");
    Route::post("/menu/updatestore/{servedate}/{timing}", [MenuController::class, "updatestore"])->name("admin-menu-updatestore");
    Route::post("/menu/swapstore/{servedate}/{timing}/{dir}", [MenuController::class, "swapstore"])->name("admin-menu-swapstore");
    Route::post("/menu/deflunchstore", [MenuController::class, "deflunchstore"])->name("admin-menu-deflunchstore");

    // **************************************************************
    // recipe
    // **************************************************************
    Route::post("/recipe/createstore", [RecipeController::class, "createstore"])->name("admin-recipe-createstore");
    Route::post("/recipe/delete/{recipe_id}", [RecipeController::class, "delete"])->name("admin-recipe-delete");
    Route::get("/recipe/index", [RecipeController::class, "index"])->name("admin-recipe-index");
    Route::get("/recipe/update/{recipe_id}", [RecipeController::class, "update"])->name("admin-recipe-update");
    Route::post("/recipe/updatestore/{recipe_id}", [RecipeController::class, "updatestore"])->name("admin-recipe-updatestore");

    // **************************************************************
    // analy
    // **************************************************************
    Route::get("/analy/calendarfood", [AnalyController::class, "calendarfood"])->name("admin-analy-calendarfood");
    Route::get("/analy/calendarnutri", [AnalyController::class, "calendarnutri"])->name("admin-analy-calendarnutri");
});
