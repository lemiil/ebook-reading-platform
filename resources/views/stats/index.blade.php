@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Статистика сайта</h1>
        <ul>
            <li>Пользователей: {{ $stats['users_count'] }}</li>
            <li>Книг: {{ $stats['books_count'] }}</li>
        </ul>
    </div>
@endsection
