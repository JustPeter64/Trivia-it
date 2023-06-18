@extends('layouts.master')

@section('content')
    <div class="col-md-12">
        <div class="col-md welcome">
            <h1>Creator page</h1>
        </div>

        @include('partials.errors')

        {{-- <div class="col-md-12"> --}}
            <form action="{{ route('creator.create') }}" method="post" class="form">
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

                <table class="table table-bordered text-left" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Tags</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            @if ($loop->iteration % 3 == 1)
                                <tr>
                            @endif
                            <td>
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                                {{ $tag->name }}
                            </td>
                            @if ($loop->iteration % 3 == 0)
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>


                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        {{-- </div> --}}
    </div>
@endsection

<style>
    .form {
        width: 100%;
    }
</style>
