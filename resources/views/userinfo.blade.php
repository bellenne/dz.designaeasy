@extends('layouts.header')
@section('content')
    <div class="container">
            <div class="mb-3">
                <label for="email" class="form-label">Ваше ФИО</label>
                <input type="email" class="form-control" readonly id="email" value="{{auth()->user()->name}}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Ваша почта</label>
                <input type="email" class="form-control" readonly id="email" value="{{auth()->user()->email}}">
            </div>

            <a href="{{ route('password.request') }}" class="btn btn-primary">Сбросить пароль</a>
    </div>
@endsection
