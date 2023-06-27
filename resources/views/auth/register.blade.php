@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
{{--                @if(auth()->user()->role_id == 1)<script>console.log("USER")</script> @endif--}}
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            @if(auth()->user()->role_id == 2)
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Роль пользователя') }}</label>
                                <div class="col-md-6">
                                    <select  class="form-control" name ="role_id">
                                        <option selected value="1">Ученик</option>
                                        <option value="3">Преподаватель</option>
                                        <option value="2">Администратор</option>
                                    </select>
                                </div>
{{--                                <input id="password-confirm" type="password" class="form-control" hidden="" name="password_confirmation" autocomplete="new-password">--}}
                            @endif
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" hidden="" name="password_confirmation" autocomplete="new-password">
                                @if(auth()->user()->role_id != 2)<input type="number" class="form-control" hidden="" name="role_id" value="1" autocomplete="new-password">@endif
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#password").change(function (e) {
            $("#password-confirm").val($("#password").val());
        });
        $("form").submit(function (e) {
            $("#password-confirm").val($("#password").val());
        });
    </script>
</div>
@endsection
