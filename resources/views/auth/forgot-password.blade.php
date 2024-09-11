@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center mb-4">
                <!-- Logo -->
                <img src="https://ipdev-portfolio.s3.us-west-1.amazonaws.com/IPExpense.png" alt="IPExpense Logo" style="height: 60px;">
            </div>
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">{{ __('Forgot Password') }}</div>

                <div class="card-body">
                    <div class="mb-3 text-sm text-muted">
                        {{ __('Forgot your password? No problem. Just let us know your email address, and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-3" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                {{ __('Back to Login') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Email Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
