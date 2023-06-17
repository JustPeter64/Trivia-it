@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md welcome">
            <h1>{{ $quiz->title }}</h1>
            {{-- <p class="lead">{{ $quiz->description }}</p> --}}
        </div>
    </div>
    <div class="col-md">
        <div class="col-md content">
            <p>{{ $quiz->content }}</p>
        </div>
    </div>
@endsection
