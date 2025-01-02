@extends('layouts.main')

@section('content')
    <div class="py-4">
        <div class="container">
            <div class="row">
                <!-- Profile Information Form -->
                <div class="container w-50">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-md-12">

                            @include('user.partials.update-profile-information-form')

                        </div>
                    </div>
                </div>

                <!-- Update Password Form -->
                <div class="container w-50">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-md-12">
                            @include('user.partials.update-password-form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
