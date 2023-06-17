@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="col-md welcome">
            <h1>Creator page - <b>Admin<b></h1>
        </div>

        @include('partials.errors')

        <div class="col-md-12">
            <form action="{{ route('admin.create') }}" method="post" class="form">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" name="description" id="description" class="form-control">
                </div>
                <div class="form-group">
                    <label for="content">content:</label>
                    <textarea name="content" id="content" class="form-control"></textarea>
                </div>
                @foreach ($tags as $tag)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"> {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
