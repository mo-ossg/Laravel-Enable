<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::view('cms/admin','cms.parent');

Route::prefix('cms/admin')->group(function(){
    Route::view('/','cms.parent');
    Route::view('/index','cms.temp.index');

    Route::resource('cities'    ,CityController::class);
    Route::resource('categories',CategoryController::class);
});

