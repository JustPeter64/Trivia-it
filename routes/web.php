<?php

use Illuminate\Support\Facades\Route;

//root route
//////////////////
Route::get('/', function () {
    return view('index');
});

//admin routes
//////////////////
Route::group(['prefix' => 'admin'], function () {
    Route::get('', [
        'uses' => 'App\Http\Controllers\QuizController@getAdminIndex',
        'as' => 'admin.index'
    ]);
    
    Route::get('create', [
        'uses' => 'App\Http\Controllers\QuizController@getAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::post('create', [
        'uses' => 'App\Http\Controllers\QuizController@postAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::get('delete/{id}', [
        'uses' => 'App\Http\Controllers\QuizController@getAdminDelete',
        'as' => 'admin.delete'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'App\Http\Controllers\QuizController@getAdminUpdate',
        'as' => 'admin.edit'
    ]);

    Route::post('edit', [
        'uses' => 'App\Http\Controllers\QuizController@postAdminUpdate',
        'as' => 'admin.update'
    ]);
});

//creator routes
//////////////////

Route::get('creator', function () {
    return view('creator.index');
})->name('creator.index');


//quiz routes
//////////////////
Route::get('quiz/{id}', [
    'uses' => 'App\Http\Controllers\QuizController@getQuiz',
    'as' => 'quizzen.quiz'
]);

//like routes
Route::get('quiz/{id}/like', [
    'uses' => 'App\Http\Controllers\QuizController@getLikeQuiz',
    'as' => 'quizzen.quiz.like'
]);

Route::get('quizzen/', [
    'uses' => 'App\Http\Controllers\QuizController@getIndex',
    'as' => 'quizzen.index'
]);

//other routes
//////////////////
Route::get('about', function () {
    return view('other.about');
})->name('other.about');


Auth::routes();

Route::post('login', [
    'uses' => 'App\Http\Controllers\SigningController@signin',
    'as' => 'auth.signin'
]);