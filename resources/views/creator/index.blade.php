@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md welcome">
            <h1>Creator page</h1>
            <p class="lead">All the Creator stuff is done here.</p>
        </div>
    </div>
    @if (Session::has('info'))
        <div class="row content">
            <div class="col-md-6">
                <p><strong>Changes:</strong></p>
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>
        </div>
    @endif
    <div class="row content">
        <div class="col-md-6">
            <a href="{{ route('creator.create') }}" class="btn btn-success creatorButton">Create a quiz</a>
        </div>
    </div>
    @foreach ($quizzes as $quiz)
        <div class="row content">
            <div class="col-md-12">
                <p>
                    <strong>{{ $quiz->title }}</strong>
                    <a href="{{ route('creator.edit', ['id' => $quiz->id ]) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('creator.delete', ['id' => $quiz->id ]) }}" class="btn btn-danger">Delete</a>
                </p>
            </div>
        </div>
    @endforeach
@endsection
