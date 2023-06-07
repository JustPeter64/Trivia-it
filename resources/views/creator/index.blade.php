@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md welcome">
            <h1>Trivia it!</h1>
            <p class="lead">Welcome to the creator section of Trivia it, here you can create your own quizzes.</p>
        </div>
    </div>
    <div class="row content">
        <div class="col-md-6">
            <a href="{{ route('creator.create') }}" class="btn btn-success creatorButton">Creator</a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('creator.edit') }}" class="btn btn-warning creatorButton">Editor</a>
        </div>
    </div>
    <div class="col-md content">
        <p>Here are some instructions on how to create your own quiz:</p>
        <ul>
            <li>First you need to create an account.</li>
            <li>Then you need to upgrade your account to a creator account.</li>
            <li>After that you can create your own quizzes.</li>
            <li>When you're done creating your quiz you can publish it.</li>
            <li>Now you can play your own quiz.</li>
            <li>And you can also share your quiz with your friends.</li>
        </ul>
    </div>
    <div class="col-md content">
        <p>Here are some instructions on how to upgrade your account to a creator account:</p>
        <ul>
            <li>First you need to create an account.</li>
            <li>Then you need to go to your account page.</li>
            <li>After that you need to click on the upgrade button.</li>
            <li>Now you're a creator.</li>
        </ul>
    </div>
    <div class="col-md content">
        <p>Here are some instructions on how to edit your own quiz:</p>
        <ul>
            <li>Afhter you created your quiz you can edit it.</li>
            <li>First need to click on the edit button.</li>
            <li>Then you can edit your quiz.</li>
            <li>When you're done editing your quiz you can re-publish it.</li>
            <li class="text-danger">Warning: When you re-publish your quiz all the ratings will be deleted.</li>
        </ul>
    </div>
@endsection
