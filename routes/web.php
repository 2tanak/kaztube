<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RubricController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChunkFileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Personal\PersonalVideoController;


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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::prefix('video')->group(function () {
    Route::get('/{video}', [VideoController::class, 'show'])->name('video.show');
    Route::get('/stream/{video}', [VideoController::class, 'stream'])->name('video.stream');
});
Route::group(['middleware' => ['auth.admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::resource('gallery', GalleryController::class);
        Route::resource('video', VideoController::class)->names('admin.video');
        Route::resource('rubric', RubricController::class)->names('admin.rubric');
        Route::resource('genre', GenreController::class)->names('admin.genre');
        Route::resource('category', CategoryController::class)->names('admin.category');
        Route::resource('users', UserController::class)->names('admin.user');
        Route::get('/{user}', [UserController::class, 'changeStatus'])->name('admin.user.status');
    });
});

Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::any('logout', 'logout')->name('logout');
    Route::post('check_login', 'check')->name('check_login');
});
Route::controller(RegisterController::class)->group(function () {
    Route::get('register', 'index')->name('auth.register-form');
    Route::post('register', 'save')->name('auth.register');
});

Route::prefix('personal')->group(function () {
    Route::get('/videos', [PersonalVideoController::class, 'index'])->name('personal-video.index');
});
