<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PersonalController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BerichtController;
use Illuminate\Support\Facades\Route;

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

/** Auth Routes */
Route::get("Anmelden",[LoginController::class,'index'])
    ->name("login");
Route::post("Anmelden",[LoginController::class,'submitLogin'])
    ->name("login.submit");
Route::post("Abmelden",[LoginController::class,'logout'])
    ->name("logout");

/** DEFAULT REDIRECTION ROUTES */

Route::get('/', function () {
    return redirect()->route("index");
});

Route::get("/Admin",function() {
    return redirect()->route("admin.index");
})->name("admin");


Route::get('/Start',[\App\Http\Controllers\HomeController::class,'index'])
    ->name("index");

Route::get('/Einsatzberichte',[BerichtController::class,'index'])
    ->name("berichte");
Route::get('/Einsatzbericht/Anlegen/{alarm}',[BerichtController::class,'create'])
    ->name("bericht.create");
Route::get('/Einsatzbericht/{bericht}',[BerichtController::class,'show'])
    ->name("bericht.show");
Route::get('/Personal',[\App\Http\Controllers\HomeController::class,'personal'])
    ->name("personal");
Route::get('/Personal/Download',[\App\Http\Controllers\HomeController::class,'download'])
    ->name("personal.download");

Route::prefix("Admin/")->name("admin.")->middleware("auth")->group(function () {
    Route::get("/Start",[HomeController::class,'index'])
        ->name("index");
    Route::get('/Personal',[PersonalController::class,'index'])
        ->name("personal");
    Route::get('/Einstellungen',[SettingController::class,'index'])
        ->name("setting");
    Route::post('/Einstellungen/Speichern',[SettingController::class,'storeSetting'])
        ->name("setting.store");
    Route::post('/Einstellungen/Passwort/peichern',[SettingController::class,'storePassword'])
        ->name("setting.password.store");
    Route::post('/Logo',[SettingController::class,'storeLogo'])
        ->name("setting.logo");
    Route::post('/Logo/Reset',[SettingController::class,'resetLogo'])
        ->name("setting.logo.reset");
    Route::get('/Funktionen',[SettingController::class,'funktionen'])
        ->name("setting.funktionen");
    Route::get('/Positionen',[SettingController::class,'positionen'])
        ->name("setting.positionen");
});
