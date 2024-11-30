@extends('layouts.main')

@section('content')
    <h1>Оглавление</h1>
    <x-reader.chapter-list :chapters="$chapters"/>
    <x-reader.content :chapters="$book"/>
@endsection
