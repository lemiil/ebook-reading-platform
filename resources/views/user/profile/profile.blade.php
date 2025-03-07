@extends('layouts.main')

@section('title')

@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h3 class="mb-2">{{ $user->name  }}</h3>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">Информация</div>
                <div class="card-body">
                    <p><strong>Дата регистрации:</strong> {{ date('d.m.Y', strtotime( $user->email_verified_at ))}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
