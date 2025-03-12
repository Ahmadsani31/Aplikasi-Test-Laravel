@extends('layouts.guest')

@section('content')
    <div class="card my-5">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <h3 class="mb-0"><b>{{ __('Register') }}</b></h3>
                <a href="{{ route('login') }}" class="link-primary">Already have an account?</a>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <x-forms.input type="text" id="name" name="name" label="{{ __('Name') }}"
                    placeholder="Your Name" value="{{ old('name') }}" required autocomplete="name" autofocus />

                <x-forms.input type="email" id="email" name="email" label="{{ __('Email') }}"
                    value="{{ old('email') }}" placeholder="Your Email" required autocomplete="email" />

                <x-forms.input type="password" id="password" name="password" label="{{ __('Password') }}"
                    placeholder="Your Password" required autocomplete="new-password" />

                <x-forms.input type="password" id="password_confirmation" name="password_confirmation"
                    label="{{ __('Confirm Password') }}" required />

                <p class="mt-4 text-sm text-muted">By Signing up, you agree to our <a href="#" class="text-primary">
                        Terms
                        of Service </a> and <a href="#" class="text-primary"> Privacy Policy</a></p>
                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                </div>

        </div>
    </div>
@endsection
