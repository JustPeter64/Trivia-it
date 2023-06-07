@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="col-md welcome">
            <h1>Editor page - <b>Admin<b></h1>
        </div>

        @include('partials.errors')

        <div class="col-md-12">
            <form action="{{ route('admin.update') }}" method="post" class="form">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    class="form-control"
                    value="{{ $quiz['title'] }}"
                    >
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input 
                    type="text"
                    name="description" 
                    id="description"
                    class="form-control"
                    value="{{ $quiz['description'] }}"
                    >
                </div>
                <div class="form-group">
                    <label for="content">content:</label>
                    <textarea
                    name="content"
                    id="content"
                    class="form-control"
                    >{{ $quiz['content'] }}
                </textarea>
                </div>  
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection