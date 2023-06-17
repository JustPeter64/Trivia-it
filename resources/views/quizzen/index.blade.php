@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md welcome">
            <h1>Quizzes</h1>
            <p class="lead">Here you can find all the quizzes.</p>
        </div>
    </div>
    @foreach ($quizzes as $quiz)
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $quiz->title }}</h2>
                <p>{{ $quiz->description }}</p>
                <p>{{ $quiz->content }}</p>
                <p><a href="{{ route('quizzen.quiz', ['id' => $quiz->id]) }}">Start Quiz</a></p>
            </div>
        </div>
        <hr>
    @endforeach
@endsection
