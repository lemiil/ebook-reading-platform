@extends('layouts.main')

@section('content')
    <div class="container w-50">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="mb-4 text-muted small">
                    Forgot your password? No problem. Just let us know your email address and we will email you a
                    password reset
                    link that will allow you to choose a new one.
                </div>
                <div class="card shadow-sm border-0 rounded">


                    @if (session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="form-control">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email"
                                   type="email"
                                   name="email"
                                   class="form-control"
                                   @if(auth()->check())
                                       value="{{ old('email', auth()->user()->email) }}"
                                   @else
                                       value="{{ old('email') }}"
                                   @endif
                                   required
                                   autofocus>
                            @if ($errors->has('email'))
                                <div class="text-danger small mt-1">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end mb-3">
                            <button type="submit" class="btn btn-dark">
                                Email Password Reset Link
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
