@extends('layouts.main')

@section('title')

@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h3 class="mb-2">Имя Пользователя</h3>
                    <p class="text-muted">example@example.com</p>
                    <button class="btn btn-dark" onclick="location.href='{{ route('user.settings')  }}';">
                        Редактировать профиль
                    </button>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">Информация</div>
                <div class="card-body">
                    <p><strong>Дата регистрации:</strong> 01.01.2023</p>
                    <p><strong>О себе:</strong> Краткое описание пользователя.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
