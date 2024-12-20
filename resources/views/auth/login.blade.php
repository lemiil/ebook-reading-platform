@extends('layouts.main')

@section('content')
    <div class="container w-50">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card shadow-sm border-0 rounded">
                    <form method="POST" action="{{ route('login') }}" class="form-control">
                        @csrf

                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input id="email"
                                   type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus
                                   autocomplete="username">
                            @if ($errors->has('email'))
                                <div class="text-danger small mt-1">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input id="password"
                                   type="password"
                                   name="password"
                                   class="form-control"
                                   required
                                   autocomplete="current-password">
                            @if ($errors->has('password'))
                                <div class="text-danger small mt-1">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none small text-muted">
                                    Forgot your password?
                                </a>
                            @endif
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center justify-content-start mb-2">
                                <a href="{{ route('auth.google') }}"
                                   class="btn btn-light d-flex align-items-center">
                                    <img src="https://img.icons8.com/color/48/000000/google-logo.png"
                                         alt="Google Logo"
                                         class="me-2"
                                         style="width: 24px; height: 24px;">
                                    Login with Google
                                </a>
                            </div>

                            <div class="d-flex justify-content-end mb-2">
                                <button type="submit" class="btn btn-light">
                                    Log in
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


