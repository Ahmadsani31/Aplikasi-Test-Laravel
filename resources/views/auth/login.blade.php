@extends('layouts.guest')

@section('content')
    <div class="card my-5">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <h3 class="mb-0"><b>{{ __('Login') }}</b></h3>
                <a href="{{ route('register') }}" class="link-primary">Don't have an account?</a>
            </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <x-forms.input type="email" id="email" name="email" label="{{ __('Email') }}"
                    value="{{ old('email') }}" required autocomplete="email" autofocus />
                <x-forms.input type="password" id="password" name="password" label="{{ __('Password') }}" required
                    autocomplete="current-password" />

                <div class="d-flex mt-1 justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember me') }}
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="text-secondary f-w-400" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
