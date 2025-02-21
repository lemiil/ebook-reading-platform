@extends('layouts.main')

@section('content')
    <div class="head">
        <ul class="chapter-list">
            <x-reader.chapter-list :chapters="$content"/>
            <x-reader.settings/>
        </ul>
    </div>
    <div id="chapters" class="chapters">
        <x-reader.content :chapters="$content"/>
    </div>
    <style>
        a:hover {
            color: rgb(38, 113, 181);
            transition: all 0.3s;
        }
    </style>

@endsection
