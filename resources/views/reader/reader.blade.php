@extends('layouts.main')

@section('content')
    <h1>Оглавление</h1>
    <ul>
        <x-reader.chapter-list :chapters="$chapters"/>
    </ul>
    <x-reader.content :chapters="$book"/>
@endsection
