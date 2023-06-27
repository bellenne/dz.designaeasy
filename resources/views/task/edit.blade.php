@extends('layouts.header')
@section('academic_subjects')
    @include("layouts.academic_subjects")
@endsection
@section('content')
    <div class="container">
        <nav class="navbar" data-bs-theme="light">
            <ul class="nav">
                <span class="navbar-text fw-bold">{{$lessenTitle}}</span>
                @foreach($tasks as $task)
                    <li class="nav-item">
                        <a class="nav-link" href="{{$task->id}}">{{$task->title}}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
@endsection
