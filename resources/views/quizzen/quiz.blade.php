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
            <p style="font-style: italic;"><b>Tags:</b>
                @foreach ($quiz->tags as $tag)
                    {{ $tag->name }}{{ $loop->last ? '' : ', ' }}
                @endforeach
            </p>
            <p>{{ $quiz->questions->count() }} Questions</p>
        </div>
    </div>
    <div class="col-md">
        <div class="col-md content">
            <h3>Questions:</h3>
            @foreach ($quiz->questions as $question)
                <div class="question">
                    <p>{{ $question->question }}</p>
                    <p>Answers:</p>
                    @foreach ($question->answers as $answer)
                        <p>{{ $answer->answer }}</p>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
