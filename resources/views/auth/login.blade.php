@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #ffffff;
        color: #333;
        font-family: 'Poppins', sans-serif;
    }

    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 80px;
        padding-bottom: 80px;
    }

    .card {
        background: #f7f9fc;
        border: none;
        border-radius: 1rem;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: transparent;
        font-size: 1.5rem;
        font-weight: 600;
        text-align: center;
        color: #2a5298;
        border-bottom: none;
        padding-top: 2rem;
    }

    .form-label {
        font-weight: 500;
        color: #2a2a2a;
    }

    .form-control {
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
        padding: 10px 15px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #2a5298;
        box-shadow: 0 0 0 0.2rem rgba(42, 82, 152, 0.25);
    }

    .btn-primary {
        background-color: #2a5298;
        border-color: #2a5298;
        border-radius: 0.5rem;
        padding: 10px 24px;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: #1e3c72;
    }

    .btn-link {
        color: #2a5298;
        font-weight: 500;
        text-decoration: none;
    }

    .btn-link:hover {
        text-decoration: underline;
    }

    .invalid-feedback {
        font-size: 0.875rem;
    }
</style>

<div class="container login-container">
    <div class="col-md-6">
        <div class="card px-4">
            <div class="card-header">
                {{ __('Login') }}
            </div>

            <div class="card-body pt-0">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
