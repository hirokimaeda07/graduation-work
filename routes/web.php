<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\ProjectController;

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
//phpspredsheet用
Route::get('/export', [ProjectController::class, 'export'])->name('export');
Route::get('/', [ProjectController::class, 'index']);
// Route::post('/download', [ProjectController::class, 'download']);
// Route::get('/output', 'SpreadSheetController@export');


Route::middleware('auth')->group(function () {
    Route::get('/project/mypage', [ProjectController::class, 'mydata'])->name('project.mypage');
    Route::resource('project', ProjectController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/tweet/mypage', [TweetController::class, 'mydata'])->name('tweet.mypage');
    Route::resource('tweet', TweetController::class);
});

Route::get('/', function () {
    return view('hello'); //topページはここで指定
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
