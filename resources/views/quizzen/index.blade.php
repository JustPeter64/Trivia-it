@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md welcome">
            <h1>Quizzes</h1>
            <p class="lead">Here you can find all the quizzes.</p>
        </div>
    </div>
    <div class="col-md">
        <div class="col-md content">
            <p>Here you can find the latest quizzes:</p>
            <ul>
                <a>
                    <li>
                        <h3>Quiz 1</h3>
                        <p>Quiz 1 description</p>
                        <a href="{{ route('quizzen.quiz', ['id' => 1]) }}">
                            Start Quiz
                        </a>
                    </li>
                </a>
                <a>
                    <li>
                        <h3>Quiz 2</h3>
                        <p>Quiz 2 description</p>
                        <a href="{{ route('quizzen.quiz', ['id' => 2]) }}">
                            Start Quiz
                        </a>
                    </li>
                </a>
                <a>
                    <li>
                        <h3>Quiz 3</h3>
                        <p>Quiz 3 description</p>
                        <a href="{{ route('quizzen.quiz', ['id' => 3]) }}">
                            Start Quiz
                        </a>
                    </li>
                </a>
                <a>
                    <li>
                        <h3>Quiz 4</h3>
                        <p>Quiz 4 description</p>
                        <a href="{{ route('quizzen.quiz', ['id' => 4]) }}">
                            Start Quiz
                        </a>
                    </li>
                </a>
                <a>
                    <li>
                        <h3>Quiz 5</h3>
                        <p>Quiz 5 description</p>
                        <a href="{{ route('quizzen.quiz', ['id' => 5]) }}">
                            Start Quiz
                        </a>
                    </li>
                </a>
            </ul>
        </div>
        <div class="col-md content">
            <p>Here you can find the most popular quizzes:</p>
            <ul>
                <a>
                    <li>Quiz 1</li>
                </a>
                <a>
                    <li>Quiz 2</li>
                </a>
                <a>
                    <li>Quiz 3</li>
                </a>
                <a>
                    <li>Quiz 4</li>
                </a>
                <a>
                    <li>Quiz 5</li>
                </a>
            </ul>
        </div>
        <div class="col-md content">
            <p>Here you can find the most popular quizzes:</p>
            <ul>
                <a>
                    <li>Quiz 1</li>
                </a>
                <a>
                    <li>Quiz 2</li>
                </a>
                <a>
                    <li>Quiz 3</li>
                </a>
                <a>
                    <li>Quiz 4</li>
                </a>
                <a>
                    <li>Quiz 5</li>
                </a>
            </ul>
        </div>
    </div>
@endsection
