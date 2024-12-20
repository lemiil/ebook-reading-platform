@extends('layouts.main')

@section('content')
    <div class="container w-50">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card shadow-sm border-0 rounded">
                    <div class="mb-4 text-sm text-muted">
                        Thanks for signing up! Before getting started, could you verify your email address by clicking
                        on the link
                        we
                        just emailed to you? If you didn't receive the email, we will gladly send you another.
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-success">
                            A new verification link has been sent to the email address you provided during registration.
                        </div>
                    @endif

                    <div class="mt-4 d-flex justify-content-between">

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                Resend Verification Email
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link text-muted">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
