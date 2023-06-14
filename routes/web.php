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
    Route::get('', function () {
        return view('admin.index');
    })->name('admin.index');
    
    Route::get('create', function () {
        return view('admin.create');
    })->name('admin.create');

    Route::post('create', function (\Illuminate\Http\Request $request, \Illuminate\Validation\Factory $validator) {
        $validation = $validator->make($request->all(), [
            'title' => 'required|min:5'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }
        return redirect()
            ->route('admin.index')
            ->with('info', 'Quiz created named: ' . $request->input('title'));
    })->name('admin.make');
    
    Route::get('edit/{id}', function ($id) {
        if ($id == 1) {
            $quiz = [
                'title' => 'Quiz 1',
                'description' => 'This is a quiz about Laravel',
                'content' => 'This is a quiz about Laravel and it is awesome and you should take it right now'
            ];
        } else {
            $quiz = [
                'title' => 'Quiz about something else',
                'description' => 'This is a quiz about something else',
                'content' => 'This is a quiz about something else and it is awesome and you should take it right now'
            ];
        }
        return view('admin.edit', ['quiz' => $quiz]);
    })->name('admin.edit');

    Route::post('edit', function (\Illuminate\Http\Request $request, \Illuminate\Validation\Factory $validator) {
        $validation = $validator->make($request->all(), [
            'title' => 'required|min:5'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }
        return redirect()
            ->route('admin.index')
            ->with('info', 'Quiz updated: ' . $request->input('title'));
    })->name('admin.update');
});

//creator routes
//////////////////

Route::get('creator', function () {
    return view('creator.index');
})->name('creator.index');

//account routes
//////////////////
Route::get('account/login', function () {
    return view('account.login');
})->name('account.login');

//quiz routes
//////////////////
Route::get('quiz/{id}', function ($id) {
    if ($id == 1) {
        $quiz = [
            'title' => 'Quiz 1',
            'description' => 'This is a quiz about Laravel',
            'content' => 'This is a quiz about Laravel and it is awesome and you should take it right now'
        ];
    } else {
        $quiz = [
            'title' => 'Quiz about something else',
            'description' => 'This is a quiz about something else',
            'content' => 'This is a quiz about something else and it is awesome and you should take it right now'
        ];
    }
    return view('quizzen.quiz', ['quiz' => $quiz]);
})->name('quizzen.quiz');

Route::get('quizzen/', [
    'uses' => 'App\Http\Controllers\QuizController@getIndex',
    'as' => 'quizzen.index'
]);

//other routes
//////////////////
Route::get('about', function () {
    return view('other.about');
})->name('other.about');