@extends('layouts.main')

@section('title')
    Нужно добавить название сюды
@endsection

@section('content')

    <div class="author-panel">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">

                    <div class="card shadow-sm border-0 rounded">
                        <div class="row g-0">
                            <div class="col-md-8 p-4">
                                <h4 class="fw-bold">{{ $authorData['name'] }}</h4>

                                <div class="description text-muted mb-4">
                                    <p>{{ $authorData['description'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
