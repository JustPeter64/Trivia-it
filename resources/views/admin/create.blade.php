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

                <div class="tag-group">
                    <h3>Tags:</h3>
                    @foreach ($tags as $tag)
                        <div class="tag-item">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                            <label for="tag">{{ $tag->name }}</label>
                        </div>
                    @endforeach
                </div>

                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary submit">Create</button>
            </form>
        </div>
    </div>
@endsection

<style>
    /* style de flexbox met tags zo dat het overzichtelijk en leesbaar is */
    .tag-group {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        width: 200%;
        margin-left: -200px;
        margin-top: 10vh;
    }

    .tag-item {
        margin: 5px;
        border: 1px solid #ccc;
        padding: 5px;
        font-size: 14px;
        font-family: sans-serif;
        font-style: italic;
    }
    .submit {
        margin-top: 5vh;
        margin-bottom: 5vh;
    }
</style>

