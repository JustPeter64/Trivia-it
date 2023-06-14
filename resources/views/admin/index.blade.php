@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md welcome">
            <h1>Admin page</h1>
            <p class="lead">All the administative stuff is done here.</p>
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
            <a href="{{ route('admin.create') }}" class="btn btn-success creatorButton">Creator</a>
        </div>
    </div>
    @foreach ($quizzes as $quiz)
        <div class="row content">
            <div class="col-md-12">
                <p>
                    <strong>{{ $quiz['title'] }}</strong>
                    <a href="{{ route('admin.edit', ['id' => array_search($quiz, $quizzes)]) }}" class="btn btn-warning">Edit</a>
                </p>
            </div>
        </div>
    @endforeach
@endsection
