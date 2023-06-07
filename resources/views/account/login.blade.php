@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md welcome">
            <h1>Log in</h1>
            <p class="lead">Here you can log in to your account.</p>
        </div>
    </div>
    <div class="form">       
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <br>
        <input type="button" value="submit">
    </div>
@endsection
