<?php

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
Route::get("Anmelden",[\App\Http\Controllers\Auth\LoginController::class,'index'])
    ->name("login");
Route::post("Anmelden",[\App\Http\Controllers\Auth\LoginController::class,'submitLogin'])
    ->name("login.submit");
Route::post("Abmelden",[\App\Http\Controllers\Auth\LoginController::class,'logout'])
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

Route::get('/Einsatzberichte',[\App\Http\Controllers\BerichtController::class,'index'])
    ->name("berichte");
Route::get('/Einsatzbericht/Anlegen/{alarm}',[\App\Http\Controllers\BerichtController::class,'create'])
    ->name("bericht.create");
Route::get('/Einsatzbericht/{bericht}',[\App\Http\Controllers\BerichtController::class,'show'])
    ->name("bericht.show");
Route::get('/Personal',[\App\Http\Controllers\HomeController::class,'personal'])
    ->name("personal");
Route::get('/Personal/Download',[\App\Http\Controllers\HomeController::class,'download'])
    ->name("personal.download");

Route::prefix("Admin/")->name("admin.")->middleware("auth")->group(function () {
    Route::get("/Start",[\App\Http\Controllers\Admin\HomeController::class,'index'])
        ->name("index");
    Route::get('/Personal',[\App\Http\Controllers\Admin\PersonalController::class,'index'])
        ->name("personal");
    Route::get('/Einstellungen',[\App\Http\Controllers\Admin\SettingController::class,'index'])
        ->name("setting");
    Route::post('/Einstellungen/Speichern',[\App\Http\Controllers\Admin\SettingController::class,'storeSetting'])
        ->name("setting.store");
    Route::post('/Einstellungen/Passwort/peichern',[\App\Http\Controllers\Admin\SettingController::class,'storePassword'])
        ->name("setting.password.store");
    Route::post('/Logo',[\App\Http\Controllers\Admin\SettingController::class,'storeLogo'])
        ->name("setting.logo");
    Route::post('/Logo/Reset',[\App\Http\Controllers\Admin\SettingController::class,'resetLogo'])
        ->name("setting.logo.reset");
    Route::get('/Funktionen',[\App\Http\Controllers\Admin\SettingController::class,'funktionen'])
        ->name("setting.funktionen");
    Route::get('/Positionen',[\App\Http\Controllers\Admin\SettingController::class,'positionen'])
        ->name("setting.positionen");
});
