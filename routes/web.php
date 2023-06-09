<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamController;

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



Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'isAdmin'],function (){

    Route::get('/', function () {
        return view('admin.index');
    });

    Route::get('/quiz/{id}/questions', [QuizController::class, 'question'])->name('quiz.question');

    Route::resource('quiz', QuizController::class);
    Route::resource('question', QuestionController::class);
    Route::resource('user', UserController::class);
    Route::get('exam/assign', [ExamController::class, 'create'])->name('user.exam');
    Route::post('exam/assign', [ExamController::class, 'assignExam'])->name('exam.assign');
    Route::get('exam/user', [ExamController::class, 'userExam'])->name('view.exam');
    Route::post('exam/remove', [ExamController::class, 'removeExam'])->name('exam.remove');
});


