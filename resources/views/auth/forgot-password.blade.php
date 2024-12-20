@extends('layouts.main')

@section('content')
    <div class="container w-50">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card shadow-sm border-0 rounded">
                    <div class="mb-4 text-muted small">
                        Forgot your password? No problem. Just let us know your email address and we will email you a
                        password reset
                        link that will allow you to choose a new one.
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email"
                                   type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus>
                            @if ($errors->has('email'))
                                <div class="text-danger small mt-1">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                Email Password Reset Link
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
