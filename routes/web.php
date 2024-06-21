<?php

use App\Http\Controllers\Admin\AdminLeadController;
use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
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

// Админка
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::name('admin.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/admin/slider', [AdminSliderController::class, 'index'])->name('slider');
        Route::post('/admin/slider', [AdminSliderController::class, 'update'])->name('slider.update');
        Route::get('/admin/leads', [AdminLeadController::class, 'index'])->name('leads');
    });


// Фронт
Route::name('front.')
    ->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('main');
        Route::post('/send', [MainController::class, 'send'])->name('send');
        Route::get('/privacy-policy', [MainController::class, 'policy'])->name('policy');
    });


//Создание символьной ссылки на папку со статикой
//Route::get('/symlink', function () {
//    $targetFolder = $_SERVER['DOCUMENT_ROOT'] .
//        DIRECTORY_SEPARATOR . 'storage' .
//        DIRECTORY_SEPARATOR . 'app' .
//        DIRECTORY_SEPARATOR . 'public';
//
//    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'storage';
//
//    symlink($targetFolder, $linkFolder);
//
//    return "create link is done";
//});

//Сброс кэша
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    return "cache is clear";
});
