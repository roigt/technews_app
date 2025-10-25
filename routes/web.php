<?php

use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\settings\SettingsController;
use App\Http\Controllers\SocialMedia\SocialMediaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('back.dashboard');
})->middleware(['auth', 'verified','checkRole:admin,author'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/**
 * partie categrie
 */
Route::resource('/category',CategoryController::class)->middleware('admin');

/**
 * fin categorie
 */

/**
 * partie arcticle
 */
Route::resource('/article',ArticleController::class)->middleware(['checkRole:admin,author']);
/**
 * fin partie article
 */

/**
 * partie auteur
 */
Route::resource('/author',UserController::class)->middleware('admin');
/**
 * fin partie auteur
 */


/**
 * partie réseaux sociaux
 */
Route::resource('/social',SocialMediaController::class)->middleware('admin');
/**
 * fin réseaux sociaux

**/

/**
 * partie parametre
 */

Route::get('/parametre',[SettingsController::class,'index'])->name('settings.index')->middleware('admin');
Route::put('/parametre',[SettingsController::class,'update'])->name('settings.update')->middleware('admin');
