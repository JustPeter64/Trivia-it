@extends('layouts.master')

@section('content')
    <div class="col-md-12">
        <div class="col-md welcome">
            <h1>Editor page</h1>
        </div>

        @include('partials.errors')

        @if (Session::has('error'))
            <div class="row content">
                <div class="col-md-6">
                    <p><strong>error:</strong></p>
                    <p class="alert alert-danger">{{ Session::get('error') }}</p>
                </div>
            </div>
        @endif

        <div class="col-md-12">
            <form action="{{ route('creator.update') }}" method="post" class="form">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $quiz->title }}">
                </div>
                {{-- <div class="form-group">
                    <label for="description">Description:</label>
                    <input 
                    type="text"
                    name="description" 
                    id="description"
                    class="form-control"
                    value="{{ $quiz->description }}"
                    >
                </div> --}}
                <div class="form-group">
                    <label for="content">content:</label>
                    <textarea name="content" id="content" class="form-control">
                    {{ $quiz->content }}
                </textarea>
                    @foreach ($tags as $tag)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                    {{ $quiz->tags->contains($tag->id) ? 'checked' : '' }}>
                                {{ $tag->name }}
                            </label>
                    @endforeach
                </div>
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $quizId }}">
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
