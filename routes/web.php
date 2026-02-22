<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\signUpController;

Route::get('/SignUp', [signUpController::class, 'index'])->name('SignUp');
Route::post('/SignUp', [signUpController::class, 'store'])->name('SignUp.store');

Route::get('/download-attachment/{filename}', [TaskController::class, 'showAttachment'])
    ->middleware('auth')
    ->name('download.show');

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/tasks/{id}/my-answer', [AnswerController::class, 'showMyAnswer'])->name('tasks.answer.my');

    Route::get('/tasks/{id}/answer', [AnswerController::class, 'answer'])->name('tasks.answer');
    Route::get('/answers/{id}/show', [AnswerController::class, 'showTheAnswer'])->name('answers.show');

    Route::patch('/answers/{id}/mark-read', [AnswerController::class, 'markAsRead'])->name('answers.markRead');

    Route::get('/tasks/{id}/listAnswer', [AnswerController::class, 'showAnswer'])->name('tasks.answer.show');
    Route::post('/tasks/{id}/answer', [AnswerController::class, 'storeAnswer'])->name('tasks.answer.store');
    Route::delete('/answers/{id}/delete', [AnswerController::class, 'deleteAnswer'])->name('answer.delete');
    
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('/tasks/{id}/listAnswer', [AnswerController::class, 'listAnswer'])->name('tasks.listAnswer');
});
