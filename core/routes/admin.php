<?php

use App\Http\Controllers\Admin\LoginController;
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

Route::get('/', [LoginController::class, 'showLoginForm'])->name('show_login');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['XSS', 'auth:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.home');
    })->name('dashboard');
    // Role Route
    Route::resource('roles', 'Admin\RoleController')->except('update');
    Route::controller('Admin\RoleController')->prefix('roles')->name('roles.')->group(function () {
        Route::post('update/{id}', 'update')->name('update');
        Route::post('list', 'list')->name('list');
        Route::post('bulk-delete', 'bulkDelete')->name('bulk_delete');
        Route::get('permissions', 'Admin\RolePermissionController@index')->name('view_permissions');
        Route::post('get-permissions', 'Admin\RolePermissionController@getPermissions')->name('get_permissions');
        Route::post('permissions-store', 'Admin\RolePermissionController@store')->name('permissions_store');
    });
    // Module Route
    Route::resource('modules', 'Admin\ModuleController')->except('update');
    Route::controller('Admin\ModuleController')->prefix('modules')->name('modules.')->group(function () {
        Route::post('update/{id}', 'update')->name('update');
        Route::post('list', 'list')->name('list');
        Route::post('bulk-delete', 'bulkDelete')->name('bulk_delete');
        Route::get('load', 'load')->name('load');
        Route::post('change-status', 'changeStatus')->name('change_status');
    });
    // Permission Route
    Route::resource('permissions', 'Admin\PermissionController')->except('update');
    Route::controller('Admin\PermissionController')->prefix('permissions')->name('permissions.')->group(function () {
        Route::post('update/{id}', 'update')->name('update');
        Route::post('list', 'list')->name('list');
        Route::post('bulk-delete', 'bulkDelete')->name('bulk_delete');
    });
    // User Route
    Route::resource('users', 'Admin\UserController')->except('update');
    Route::controller('Admin\UserController')->prefix('users')->name('users.')->group(function () {
        Route::post('update/{id}', 'update')->name('update');
        Route::post('update-profile/{id}', 'updateProfile')->name('update_profile');
        Route::post('list', 'list')->name('list');
        Route::post('bulk-delete', 'bulkDelete')->name('bulk_delete');
        Route::post('change-status', 'changeStatus')->name('change_status');
    });
    Route::post('get-permissions', 'Admin\UserPermissionController@getPermissions')->name('get_permissions');
    Route::post('permissions-store', 'Admin\UserPermissionController@store')->name('permissions_store');
    // Admin Route
    Route::resource('admins', 'Admin\AdminController')->except('update');
    Route::controller('Admin\AdminController')->prefix('admins')->name('admins.')->group(function () {
        Route::post('update/{id}', 'update')->name('update');
        Route::post('update-profile/{id}', 'updateProfile')->name('update_profile');
        Route::post('list', 'list')->name('list');
        Route::post('bulk-delete', 'bulkDelete')->name('bulk_delete');
        Route::post('change-status', 'changeStatus')->name('change_status');
    });
    Route::post('admin-permissions', 'Admin\AdminPermissionController@getPermissions')->name('admin_permissions');
    Route::post('admin-permissions-store', 'Admin\AdminPermissionController@store')->name('admin_permissions_store');
    // Language Route
    Route::resource('languages', 'Admin\LanguageController')->except('update');
    Route::controller('Admin\LanguageController')->prefix('languages')->name('languages.')->group(function () {
        Route::post('update/{id}', 'update')->name('update');
        Route::post('update-profile/{id}', 'updateProfile')->name('update_profile');
        Route::post('list', 'list')->name('list');
        Route::post('bulk-delete', 'bulkDelete')->name('bulk_delete');
    });
    // Language Route
    Route::controller('Admin\LanguageDetailsController')->prefix('languages-details')->name('languages_details.')->group(function () {
        Route::post('store', 'store')->name('store');
        Route::post('{id}/update/{key}', 'update')->name('update');
        Route::post('{id}/delete/{key}', 'destroy')->name('destroy');
        Route::post('bulk-delete', 'bulkDelete')->name('bulk_delete');
    });

    Route::controller('HomeController')->prefix('site-settings')->name('site_settings.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('optimize-clear', 'optimizeClear')->name('optimize_clear');
    });
});
