@extends('layouts.main')

@section('title')
    Books Main
@endsection

@section('content')

    @include('book.forms.book-form')


    <style>
        .cursor-pointer {
            cursor: pointer;
        }

        .form-control {
            border-radius: 0.375rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .tag-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .tag {
            padding: 0.3rem 0.6rem;
            background: #e0e0e0;
            border: 1px solid #ccc;
            border-radius: 0.3rem;
        }

        .remove-tag {
            cursor: pointer;
        }
    </style>
@endsection
