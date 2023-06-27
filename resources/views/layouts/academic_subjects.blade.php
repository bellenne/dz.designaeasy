@extends('layouts.header')
@section("academic_subjects")
<nav class="navbar bg-body-tertiary" data-bs-theme="light">
    <ul class="nav">
        @foreach($academic_subjects as $academic_subject)
            <li class="nav-item">
                <a class="nav-link" href="{{route("lessens",$academic_subject->url_address)}}">{{$academic_subject->name}}</a>
            </li>
        @endforeach
    </ul>
</nav>
@endsection
