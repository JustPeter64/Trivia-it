@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md welcome">
            <h1>{{ $quiz->title }}</h1>
            <p class="lead">{{ $quiz->description }}</p>
        </div>
    </div>
    <div class="col-md">
        <div class="col-md content">
            <p>{{ count($quiz->likes) }} Likes |
                <a href="{{ route('quizzen.quiz.like', ['id' => $quiz->id]) }}">Like</a>
            </p>
        </div>
    </div>
    <div class="col-md">
        <div class="col-md content">
            <p>{{ $quiz->content }}</p>
        </div>
    </div>
@endsection
