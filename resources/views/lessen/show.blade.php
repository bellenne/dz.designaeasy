@extends('layouts.header')
@section('academic_subjects')
    @include("layouts.academic_subjects")
@endsection
@section('content')
    <nav class="navbar" data-bs-theme="light">
        <ul class="nav">
            @foreach($lessens as $lessen)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('tasks', $lessen->id)}}">{{$lessen->title}}</a>
                </li>
            @endforeach
        </ul>
    </nav>

@endsection
