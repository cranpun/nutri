<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Student\StudentController;
use \App\Http\Controllers\Admin\User\UserController;

Route::middleware(["can:admin","auth"])->group(function () {
    Route::get("/", [UserController::class, "index"])->name("top"); // MYTODO 生徒一覧ができればそれに変更。

    // **************************************************************
    // user
    // **************************************************************
    Route::get("/user/create", [UserController::class, "create"])->name("admin-user-create");
    Route::post("/user/store", [UserController::class, "store"])->name("admin-user-store");
    Route::post("/user/delete/{user_id}", [UserController::class, "delete"])->name("admin-user-delete");
    Route::post("/user/changepassword/{user_id}", [UserController::class, "changepassword"])->name("admin-user-changepassword");
    Route::post("/user/overwritepassword/{user_id}", [UserController::class, "overwritepassword"])->name("admin-user-overwritepassword");
    Route::get("/user/index", [UserController::class, "index"])->name("admin-user-index");
    Route::get("/user/update/{user_id}", [UserController::class, "update"])->name("admin-user-update");

});
