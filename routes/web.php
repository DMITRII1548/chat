<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('chats')->group(function () {
        // Chat Routes
        Route::get('/', [ChatController::class, 'index'])->name('chats.index');
        Route::get('/create', [ChatController::class, 'create'])->name('chats.create');
        Route::post('/', [ChatController::class, 'store'])->name('chats.store');
        Route::get('/{chat}/settings', [ChatController::class, 'settings'])->name('chats.settings');
        Route::get('/{chat}/addUser', [ChatController::class, 'addUser'])->name('chats.addUser');
        Route::patch('/{chat}/includeUser', [ChatController::class, 'includeUser'])->name('chats.includeUser');
        Route::delete('/{chat}/destroyUser/{user}', [ChatController::class, 'destroyUser'])->name('chats.destroyUser');

        // Message Routes
        Route::get('/{chat}/messages', [MessageController::class, 'index']);
        Route::post('/{chat}/messages', [MessageController::class, 'store'])->name('messages.post');
    });

});

require __DIR__.'/auth.php';
