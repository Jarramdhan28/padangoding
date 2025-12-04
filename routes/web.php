<?php

use Illuminate\Support\Facades\Route;

/** Landing Page */
Route::get('/', [App\Http\Controllers\Guest\LandingPageController::class, 'index'])->name('landing-page');

/**
 *  Admin Routes
*/
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'role:admin']], function (){
    /** Dashboard */
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    /** Notification */
    Route::controller(App\Http\Controllers\Admin\NotificationController::class)->group(function(){
        Route::get('/notifications', 'getNotofications')->name('admin.notifications');
        Route::post('/notifications/mark-as-read/{notificationId}', 'markAsRead')->name('admin.notifications.markAsRead');
        Route::delete('/notifications/delete/{notificationId}', 'destroy')->name('admin.notifications.destroy');
    });
    /** Referensi */
    Route::group(['prefix' => 'referensi'], function (){
        /** Category */
        Route::resource('category', App\Http\Controllers\Admin\Reference\CategoryController::class)->except('show', 'create', 'edit');
        Route::get('/category/get', [App\Http\Controllers\Admin\Reference\CategoryController::class, 'get']);
        /** Tag */
        Route::resource('tag', App\Http\Controllers\Admin\Reference\TagController::class)->except('show', 'create', 'edit');
        Route::get('/tag/get', [App\Http\Controllers\Admin\Reference\TagController::class, 'get']);
    });
    /** Articl */
    Route::group(['prefix' => 'article'], function(){
        Route::get('/', [App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('admin.article.index');
        Route::get('/get', [App\Http\Controllers\Admin\ArticleController::class, 'getData'])->name('admin.article.getData');
        Route::get('/detail/{article:slug}', [App\Http\Controllers\Admin\ArticleController::class, 'detailPage'])->name('admin.article.detail');
        Route::get('/get-detail/{article:slug}', [App\Http\Controllers\Admin\ArticleController::class, 'getDataDetails'])->name('admin.article.getDetail');
        Route::post('/detail/update-status/{article:slug}', [App\Http\Controllers\Admin\ArticleController::class, 'statusUpdate'])->name('admin.article.updateStatus');
    });
    /** User Management */
    Route::resource('user-management', App\Http\Controllers\Admin\UserManagementController::class)->except('show', 'create', 'edit');
    Route::get('/user-management/get', [App\Http\Controllers\Admin\UserManagementController::class, 'getData'])->name('user-management.getData');
    Route::get('/user-management/roles', [App\Http\Controllers\Admin\UserManagementController::class, 'getRole'])->name('user-management.getRole');
    Route::post('/user-management/set-role/{user:id}', [App\Http\Controllers\Admin\UserManagementController::class, 'setRole'])->name('user-management.setRole');
});

/** Creator Routes */
Route::group(['prefix' => 'creator', 'middleware' => ['auth', 'verified', 'role:creator']], function (){
    /** Dashboard */
    Route::get('/dashboard', [App\Http\Controllers\Creator\DashboardController::class, 'index'])->name('creator.dashboard');
    /** Profile */
    Route::controller(App\Http\Controllers\Creator\ProfileController::class)->group(function(){
        Route::get('/profile', 'index')->name('creator.profile.index');
        Route::get('/get-profile', 'getData')->name('creator.profile.getData');
        Route::get('/profile/pengaturan', 'accountSettings')->name('creator.profile.accountSettings');
        Route::put('/profile/update', 'update')->name('creator.profile.update');
        Route::post('/profile/upload', 'uploadProfile')->name('creator.profile.uploadProfile');
    });
    /** Article */
    Route::controller(App\Http\Controllers\Creator\ArticleController::class)->group(function(){
        Route::get('/article', 'index')->name('creator.article.index');
        Route::get('/get-articles', 'getArticles')->name('creator.get');
        Route::get('/create-article', 'create')->name('creator.article.create');
        Route::post('/create-article', 'store')->name('creator.article.store');
        Route::get('/article/update/{article:slug}', 'editPage')->name('creator.article.editPage');
        Route::get('/article/edit/{article:slug}', 'getArticleBySlug')->name('creator.article.getArticleBySlug');
        Route::put('/article/update/{article:slug}', 'update')->name('creator.article.update');
        Route::get('/article/detail/{article:slug}', 'detailPage')->name('creator.article.detailPage');
        Route::delete('/article/delete/{article:slug}', 'destroy')->name('creator.article.destroy');
    });
});

/**
 *  Referensi Routes
*/
Route::get('/reference/categories', [App\Http\Controllers\ReferenceController::class, 'categories'])->name('reference.categories');

require __DIR__.'/auth.php';
