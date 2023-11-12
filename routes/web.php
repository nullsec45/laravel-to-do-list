<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController, HomeController};
use App\Http\Middleware\OnlyGuestMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,"home"]);

Route::controller(UserController::class)->group(function(){
    Route::get("/login","login")->name("page.login")->middleware([OnlyGuestMiddleware::class]);
    Route::post("/login","doLogin")->name("login")->middleware([OnlyGuestMiddleware::class]);
    Route::post("/logout","doLogout")->name("logout");
});
