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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware(['auth'])->name('dashboard');
Route::get('/profile', 'App\Http\Controllers\ProfileController@index')->middleware(['auth'])->name('profile');
Route::post('/change-password', 'App\Http\Controllers\ProfileController@change')->middleware(['auth'])->name('change-password');

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('/user/dashboard', 'App\Http\Controllers\user\DashboardController@index')->name('user-dashboard');

    Route::get('/user/payments', 'App\Http\Controllers\user\PaymentsController@index')->name('user-payments');
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/dashboard', 'App\Http\Controllers\admin\DashboardController@index')->name('admin-dashboard');

    Route::get('/admin/users', 'App\Http\Controllers\admin\UsersController@index')->name('admin-users');
    Route::get('/admin/remove/user/{id}', 'App\Http\Controllers\admin\UsersController@remove')->name('admin-remove-user');

    Route::get('/admin/vehicle-categories', 'App\Http\Controllers\admin\VehicleCategoryController@index')->name('admin-categories');
    Route::post('/admin/add/category', 'App\Http\Controllers\admin\VehicleCategoryController@add')->name('admin-add-category');
    Route::post('/admin/delete/category', 'App\Http\Controllers\admin\VehicleCategoryController@delete')->name('admin-delete-category');
    Route::post('/admin/edit/category', 'App\Http\Controllers\admin\VehicleCategoryController@edit')->name('admin-edit-category');

    Route::get('/admin/duty-payments', 'App\Http\Controllers\admin\DutyController@index')->name('admin-duty');
    Route::post('/admin/download/duty', 'App\Http\Controllers\admin\DutyController@download')->name('admin-download-duty');
});

require __DIR__.'/auth.php';
