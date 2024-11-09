@extends('layouts.main')

@section('title')
    Нужно добавить название сюды
@endsection


@section('content')

    <div class="book-panel">
        <div class="container mt-5 border rounded shadow-sm">
            <div class="row border p-3 bg-light">
                <div class="col-md-4 d-flex flex-column align-items-center">
                    <img src="https://archives.colta.ru/wp-content/uploads/2017/07/stenbergs_vertov.jpg"
                         class="img-fluid mb-3">
                    <h5>Название</h5>
                </div>
                <div class="col-md-8">
                    <h3>Описание</h3>
                    <p>
                    <pre>{{ $description }}</pre>
                    </p>
                    {{ $cover }}
                </div>
            </div>
        </div>
    </div>

@endsection
