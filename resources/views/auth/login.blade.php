@extends('layouts.main')

@section('content')
    <div class="container w-50">
        <form method="POST" action="{{ route('login') }}" class="p-4 border rounded bg-light shadow-sm">
            @csrf

            <div class="mb-3">
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

            <div class="mb-3">
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
                <a href="{{ route('auth.google') }}" class="btn btn-outline-primary">
                    Login with Google
                </a>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-none small text-muted">
                        Forgot your password?
                    </a>
                @endif
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    Log in
                </button>
            </div>
        </form>
    </div>
@endsection


