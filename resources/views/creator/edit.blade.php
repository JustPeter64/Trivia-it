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
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" name="description" id="description" class="form-control"
                        value="{{ $quiz->description }}">
                </div>

                @for ($p = 1; $p < 4; $p++)
                    <div class="question">
                        <div class="form-group">
                            <label for="question{{ $p }}">Question {{ $p }}:</label>
                            <input type="text" name="question{{ $p }}" id="question{{ $p }}"
                                class="form-control" value="{{ $quiz->questions[$p - 1]->question }}">
                        </div>

                        @for ($i = 1; $i < 5; $i++)
                            <div class="form-group">
                                <label
                                    for="answer{{ $p }}{{ $i }}">Answer{{ $i }}:</label>
                                <input type="text" name="answer{{ $p }}{{ $i }}"
                                    id="answer{{ $p }}{{ $i }}" class="form-control"
                                    value="{{ $quiz->questions[$p - 1]->answers[$i - 1]->answer }}">

                                <label for="correct{{ $p }}{{ $i }}">Correct:</label>
                                <select name="correct{{ $p }}{{ $i }}"
                                    id="correct{{ $p }}{{ $i }}">
                                    <option value="0">False</option>
                                    <option value="1">True</option>
                                </select>
                            </div>
                        @endfor
                    </div>
                @endfor
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
                <input type="hidden" name="id" value="{{ $quizId }}">
                <button type="submit" class="btn btn-primary submit">Update</button>
            </form>
        </div>
    </div>
@endsection

<style>
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