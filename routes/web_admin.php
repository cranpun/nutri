<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\User\UserController;
use \App\Http\Controllers\Admin\Food\FoodController;

Route::middleware(["can:admin","auth"])->group(function () {
    Route::get("/", [UserController::class, "index"])->name("top"); // MYTODO 生徒一覧ができればそれに変更。

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
    Route::get("/food/create", [FoodController::class, "create"])->name("admin-food-create");
    Route::post("/food/createstore", [FoodController::class, "createstore"])->name("admin-food-createstore");
    Route::post("/food/delete/{food_id}", [FoodController::class, "delete"])->name("admin-food-delete");
    Route::get("/food/index", [FoodController::class, "index"])->name("admin-food-index");
    Route::get("/food/update/{food_id}", [FoodController::class, "update"])->name("admin-food-update");
    Route::post("/food/updatestore/{food_id}", [FoodController::class, "updatestore"])->name("admin-food-updatestore");
});
