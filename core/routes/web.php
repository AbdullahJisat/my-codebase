<?php

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

Route::get('/', function () {
    return to_route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class])->middleware('auth')->name('home');
Route::get('/dashboard', function () {
    return view('home');
})->middleware('auth')->name('dashboard');
Route::middleware('auth')->group(function () {
    // User Route
    Route::resource('users', 'UserController')->except('update');
    Route::controller('UserController')->prefix('users')->name('users.')->group(function () {
        Route::post('update/{id}', 'update')->name('update');
        Route::post('update-profile/{id}', 'updateProfile')->name('update_profile');
        Route::post('list', 'list')->name('list');
        Route::post('bulk-delete', 'bulkDelete')->name('bulk_delete');
        Route::post('change-status', 'changeStatus')->name('change_status');
    });
});
