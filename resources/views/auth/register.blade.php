@extends('layouts.main')

@section('content')
    <div class="container w-50">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card shadow-sm border-0 rounded">
                    <form method="POST" action="{{ route('register') }}" class="form-control">
                        @csrf

                        <!-- Name -->
                        <div class="mb-2">
                            <label for="name" class="form-label">Name</label>
                            <input id="name"
                                   type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name') }}"
                                   required
                                   autofocus
                                   autocomplete="name">
                            @if ($errors->has('name'))
                                <div class="text-danger small mt-1">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input id="email"
                                   type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email') }}"
                                   required
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
                                   autocomplete="new-password">
                            @if ($errors->has('password'))
                                <div class="text-danger small mt-1">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <div class="mb-2">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input id="password_confirmation"
                                   type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   required
                                   autocomplete="new-password">
                            @if ($errors->has('password_confirmation'))
                                <div class="text-danger small mt-1">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            @endif
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-2">

                            <a href="{{ route('login') }}"
                               class="small text-muted text-decoration-none">
                                Already registered?
                            </a>

                            <button type="submit" class="justify-content-end btn btn-dark">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
