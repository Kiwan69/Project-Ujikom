@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #ffffff;
        color: #343a40;
    }
    .register-card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .register-card-header {
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        color: #fff;
        font-weight: 600;
        text-align: center;
        padding: 1rem 2rem;
        font-size: 1.25rem;
    }
    .form-control {
        border-radius: 0.5rem;
        padding: 0.75rem;
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(30, 60, 114, 0.25);
        border-color: #1e3c72;
    }
    .btn-primary {
        background-color: #1e3c72;
        border: none;
        border-radius: 0.5rem;
        padding: 0.6rem 1.5rem;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #16335e;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card register-card">
                <div class="register-card-header">{{ __('Create Your Account') }}</div>

                <div class="card-body px-4 py-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autofocus>

                            @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required>

                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password" required>

                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password"
                                class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
