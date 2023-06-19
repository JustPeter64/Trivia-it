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
                <p style="font-style: italic;"><b>Tags:</b>
                    @foreach ($quiz->tags as $tag)
                        {{ $tag->name }}{{ $loop->last ? '' : ', ' }}
                    @endforeach
                <p>{{ $quiz->description }}</p>
                <p><a href="{{ route('quizzen.quiz', ['id' => $quiz->id]) }}">Start Quiz</a></p>
            </div>
        </div>
        <hr>
    @endforeach
    {{-- pagination --}}
    <div class="row">
        <div class="col-md-12 text-center d-flex justify-content-center">
            {{ $quizzes->Links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection