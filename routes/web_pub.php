<?php
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Pub\User\UserController;

/************************************************************/
// user
/************************************************************/
Route::get("/login", [UserController::class, "login"])->name("login");
Route::post("/authenticate", [UserController::class, "authenticate"])->name("authenticate");
Route::post("/logout", function () {
    if (\Auth::user()) {
        \Auth::logout();
    }
    return redirect()->route("login");
})->name("logout");
