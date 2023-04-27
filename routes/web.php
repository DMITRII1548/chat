<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatUserController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Chat Routes
    Route::get('/', [ChatController::class, 'index'])->name('chats.index');
    Route::prefix('chats')->group(function () {
        Route::get('/create', [ChatController::class, 'create'])->name('chats.create');
        Route::post('/', [ChatController::class, 'store'])->name('chats.store');
        Route::get('/{chat}/edit', [ChatController::class, 'edit'])->name('chats.edit');

        // Chat User Routes
        Route::get('/{chat}/users', [ChatUserController::class, 'index'])->name('chat.users.index');
        Route::get('/{chat}/users/create', [ChatUserController::class, 'create'])->name('chat.users.create');
        Route::post('/{chat}/users', [ChatUserController::class, 'store'])->name('chat.users.store');
        Route::delete('/{chat}/users/{user}', [ChatUserController::class, 'destroy'])->name('chat.users.destroy');

        // Message Routes
        Route::get('/{chat}/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::post('/{chat}/messages', [MessageController::class, 'store'])->name('messages.post');
    });

});

require __DIR__.'/auth.php';
