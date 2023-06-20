@extends('layouts.master')

@section('content')
    <div class="col-md-12">
        <div class="col-md welcome">
            <h1>Creator page</h1>
        </div>

        @include('partials.errors')

        <form action="{{ route('creator.create') }}" method="post" class="form" style="text-align: left;">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" name="description" id="description" class="form-control">
            </div>

            <div class="question">
                <div class="form-group">
                    <label for="question">Question:</label>
                    <input type="text" name="question" id="question" class="form-control">
                </div>

                @for ($i = 1; $i < 5; $i++)
                    <div class="form-group">
                        <label for="answer{{ $i }}">Answer {{ $i }}:</label>
                        <input type="text" name="answer{{ $i }}" id="answer{{ $i }}" class="form-control">
                       
                        <label for="correct{{ $i }}">Correct:</label>
                        <select name="correct{{ $i }}" id="correct{{ $i }}">
                            <option value="0">False</option>
                            <option value="1">True</option>
                        </select>
                    </div>
                @endfor
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

    .correct-group {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        width: 80%;
    }

    #correct {
        width: 20px;
        height: 20px;

    }

    .question {
        border: 1px solid #ccc;
    }
</style>
