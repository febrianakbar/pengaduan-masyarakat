<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them
| will be assigned to the "web" middleware group. Make something great!
|
*/

// Halaman Utama
Route::get('/', function () {
    return view('pages.home');
})->name('home');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate'])->name('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Report Routes
Route::prefix('report')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('report.index'); 
    Route::get('/create', [ReportController::class, 'create'])->name('report.create'); 
    Route::post('/', [ReportController::class, 'store'])->name('report.store'); 
    Route::get('/search', [ReportController::class, 'search'])->name('report.search');
    Route::get('/{id}', [ReportController::class, 'show'])->name('report.show');
    Route::post('/{id}/vote', [ReportController::class, 'vote'])->name('report.vote');

});


Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');


Route::get('/pages/report', [ReportController::class, 'page'])->name('pages.report');

Route::get('/staff/dashboard', [ReportController::class, 'dashboard'])->name('staff.dashboard');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/staff/report', [ReportController::class, 'action'])->name('staff.report');