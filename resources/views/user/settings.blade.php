@extends('layouts.main')

@section('title')
    Settings
@endsection

@section('content')
    <div class="py-4">
        <div class="container">
            <div class="row">

                <div class="col-md-6 w-50">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-md-12">
                            @include('user.partials.update-profile-information-form')
                            <div class="mt-5">
                                @include('user.partials.forgot-password-button')
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-6 w-50">
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
