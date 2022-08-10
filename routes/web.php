<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

//admin route
Route::group(['prefix'=>'admin','middleware'=>['admin:admin']],function (){
    Route::controller(AdminController::class)->group(function (){
        Route::get('/login','LoginForm')->name('admin.login');
        Route::post('/login','Store')->name('admin.login');
    });

});

//admin dashboard
Route::middleware([
    'auth:sanctum,admin',
    'verified'
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});




//user
Route::middleware([
    'auth:sanctum,web',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
