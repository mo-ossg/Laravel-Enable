<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\BrokerPermissionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPermissionController;
use App\Mail\AdminWelcomeEmail;
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

// Route::view('/cms/admin', 'cms.parent');

Route::prefix('cms')->middleware('guest:admin,broker')->group(function(){
    Route::get ('{guard}/login', [AuthController::class, 'showLogin'])->name('auth.login-view');
    Route::post('login',         [AuthController::class, 'login'    ])->name('auth.login');
});

Route::prefix('cms/admin')->middleware('auth:admin')->group(function() {
    Route::resource('admins', AdminController::class);
    Route::resource('brokers', BrokerController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::put('roles/{role}/permission',[RolePermissionController::class,'update'])->name('role-permission.update');

    Route::get('brokers/{id}/permission',[BrokerPermissionController::class, 'edit'])->name('broker-permissions.edit');
    Route::put('brokers/{id}/permission',[BrokerPermissionController::class, 'update'])->name('broker-permissions.update');

    Route::get('users/{id}/permission',[UserPermissionController::class, 'edit'])->name('user-permissions.edit');
    Route::put('users/{id}/permission',[UserPermissionController::class, 'update'])->name('user-permissions.update');
});

Route::prefix('cms/admin')->middleware('auth:admin,broker')->group(function(){
    Route::view('/'      , 'cms.parent');
    Route::view('/index' , 'cms.temp.index');

    Route::resource('cities'    , CityController::class);
    Route::resource('categories', CategoryController::class);

    Route::get('edit-password'   , [AuthController::class, 'editPassword'  ])->name('auth.edit-password');
    Route::put('update-password' , [AuthController::class, 'updatePassword']);

    Route::get('edit-profile'   , [AuthController::class, 'editProfile'  ])->name('auth.edit-profile');
    Route::put('update-profile' , [AuthController::class, 'updateProfile']);

    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});


Route::get('email',function() {
    return new AdminWelcomeEmail();
});













// Route::get('age', function(){
//     echo "Show News - Age Is Accepted";  // بستخدم هادي الطريقة kernel داخل ملف middleware لو كنت معرف ال
// })->middleware('age');

// Route::get('age', function(){
//     echo "Show News - Age Is Accepted";     // بستخدم هادي الطريقة kernel داخل ملف middleware لو ما كنت معرف او معرف ال
// })->middleware(ChickAge::class);


// Route::prefix('mw')->middleware('age:19')->group(function(){    // array بحطهم داخل middleware لو كان عندي اكثر من
//     Route::get('Chick1',function(){
//         echo 'Chick 1 Passed';
//     });

//     Route::get('Chick2',function(){
//         echo 'Chick 2 Passed';
//     })->withoutMiddleware('age');            // معممة على كل الروابط ما عدا هادا middleware هيك
// });


