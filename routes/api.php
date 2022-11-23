<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/user-registry',[\App\Http\Controllers\UserController::class,'create']);
Route::post('/user-auth',[App\Http\Controllers\UserController::class,'show']);


/*
|--------------------------------------------------------------------------
| Category
|--------------------------------------------------------------------------
*/

Route::get('/category/all',[\App\Http\Controllers\CategoryModelController::class,'index'])->middleware('auth:sanctum');

Route::post('/category/create',[\App\Http\Controllers\CategoryModelController::class,'create'])->middleware('auth:sanctum');

Route::put('/category/edit/{id}',[\App\Http\Controllers\CategoryModelController::class,'edit'])->middleware('auth:sanctum');

Route::delete('/category/delete/{id}',[\App\Http\Controllers\CategoryModelController::class,'destroy'])->middleware('auth:sanctum');


/*
|--------------------------------------------------------------------------
| Answer
|--------------------------------------------------------------------------
*/


Route::get('/answer/all',[\App\Http\Controllers\AnswerModelController::class,'index'])->middleware('auth:sanctum');

Route::post('/answer/create',[\App\Http\Controllers\AnswerModelController::class,'create'])->middleware('auth:sanctum');

Route::put('/answer/edit/{id}',[\App\Http\Controllers\AnswerModelController::class,'edit'])->middleware('auth:sanctum');

Route::delete('/answer/delete/{id}',[\App\Http\Controllers\AnswerModelController::class,'destroy'])->middleware('auth:sanctum');


/*
|--------------------------------------------------------------------------
| PassQuiz
|--------------------------------------------------------------------------
*/


Route::get('/pass-quiz/all',[\App\Http\Controllers\PassQuizModelController::class,'index'])->middleware('auth:sanctum');

Route::post('/pass-quiz/create',[\App\Http\Controllers\PassQuizModelController::class,'create'])->middleware('auth:sanctum');

Route::put('/pass-quiz/edit/{id}',[\App\Http\Controllers\PassQuizModelController::class,'edit'])->middleware('auth:sanctum');

Route::delete('/pass-quiz/delete/{id}',[\App\Http\Controllers\PassQuizModelController::class,'destroy'])->middleware('auth:sanctum');



/*
|--------------------------------------------------------------------------
| Question
|--------------------------------------------------------------------------
*/


Route::get('/question/all',[\App\Http\Controllers\QuestionModelController::class,'index'])->middleware('auth:sanctum');

Route::post('/question/create',[\App\Http\Controllers\QuestionModelController::class,'create'])->middleware('auth:sanctum');

Route::put('/question/edit/{id}',[\App\Http\Controllers\QuestionModelController::class,'edit'])->middleware('auth:sanctum');

Route::delete('/question/delete/{id}',[\App\Http\Controllers\QuestionModelController::class,'destroy'])->middleware('auth:sanctum');

/*
|--------------------------------------------------------------------------
| Advice
|--------------------------------------------------------------------------
*/


Route::get('/advice/all',[\App\Http\Controllers\AdviceModelController::class,'index'])->middleware('auth:sanctum');

Route::post('/advice/create',[\App\Http\Controllers\AdviceModelController::class,'create'])->middleware('auth:sanctum');

Route::put('/advice/edit/{id}',[\App\Http\Controllers\AdviceModelController::class,'edit'])->middleware('auth:sanctum');

Route::delete('/advice/delete/{id}',[\App\Http\Controllers\AdviceModelController::class,'destroy'])->middleware('auth:sanctum');


/*
|--------------------------------------------------------------------------
| Quiz
|--------------------------------------------------------------------------
*/


Route::get('/quiz/all',[\App\Http\Controllers\QuizModelController::class,'index'])->middleware('auth:sanctum');

Route::post('/quiz/create',[\App\Http\Controllers\QuizModelController::class,'create'])->middleware('auth:sanctum');

Route::put('/quiz/edit/{id}',[\App\Http\Controllers\QuizModelController::class,'edit'])->middleware('auth:sanctum');

Route::delete('/quiz/delete/{id}',[\App\Http\Controllers\QuizModelController::class,'destroy'])->middleware('auth:sanctum');


/*
|--------------------------------------------------------------------------
| Role
|--------------------------------------------------------------------------
*/


Route::get('/role/all',[\App\Http\Controllers\RoleModelController::class,'index'])->middleware('auth:sanctum');

Route::post('/role/create',[\App\Http\Controllers\RoleModelController::class,'create'])->middleware('auth:sanctum');

Route::put('/role/edit/{id}',[\App\Http\Controllers\RoleModelController::class,'edit'])->middleware('auth:sanctum');

Route::delete('/role/delete/{id}',[\App\Http\Controllers\RoleModelController::class,'destroy'])->middleware('auth:sanctum');
