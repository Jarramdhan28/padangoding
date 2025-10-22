<?php

use Illuminate\Support\Facades\Route;

/** Landing Page */
Route::get('/', [App\Http\Controllers\Guest\LandingPageController::class, 'index'])->name('landing-page');

/**
 *  Admin Routes
*/
/** Dashboard */
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'role:admin']], function (){
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    /** Referensi */
    Route::group(['prefix' => 'referensi'], function (){
        /** Category */
        Route::resource('category', App\Http\Controllers\Admin\Reference\CategoryController::class)->except('show', 'create', 'edit');
        Route::get('/category/get', [App\Http\Controllers\Admin\Reference\CategoryController::class, 'get']);
        /** Tag */
        Route::resource('tag', App\Http\Controllers\Admin\Reference\TagController::class)->except('show', 'create', 'edit');
        Route::get('/tag/get', [App\Http\Controllers\Admin\Reference\TagController::class, 'get']);
    });
    /** User Management */
    Route::resource('user-management', App\Http\Controllers\Admin\UserManagementController::class)->except('show', 'create', 'edit');
    Route::get('/user-management/get', [App\Http\Controllers\Admin\UserManagementController::class, 'getData'])->name('user-management.getData');
    Route::get('/user-management/roles', [App\Http\Controllers\Admin\UserManagementController::class, 'getRole'])->name('user-management.getRole');
    Route::post('/user-management/set-role/{user:id}', [App\Http\Controllers\Admin\UserManagementController::class, 'setRole'])->name('user-management.setRole');
});

Route::group(['prefix' => 'creator', 'middleware' => ['auth', 'verified', 'role:creator']], function (){
    /** Dashboard */
    Route::get('/dashboard', [App\Http\Controllers\Creator\DashboardController::class, 'index'])->name('creator.dashboard');
});

Route::get('/article', function(){
    return true;
})->name('article');

require __DIR__.'/auth.php';
