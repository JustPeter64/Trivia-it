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
        </div>
    </div>
    <div class="col-md">
        <div class="col-md content">
            <h3>Questions:</h3>
            @foreach ($quiz->questions as $question)
                <div class="question">
                    <p>{{ $question->question }}</p>
                    @foreach ($question->answers as $answer)
                        <div class="answer">
                            <input type="hidden" name="answer_id" value="{{ $answer->id }}">
                            <input type="hidden" name="correct" value="{{ $answer->correct }}">
                            <input type="checkbox" name="answer" id="answer">
                            <label for="answer">{{ $answer->answer }}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection

<style>
    .question {
        border: 1px solid #ccc;
    }

    .answer label {
        margin-left: 10px;
    }

    .answer input {
        margin-left: 10px;
    }

    .question {
        margin-bottom: 20px;
    }
</style>
