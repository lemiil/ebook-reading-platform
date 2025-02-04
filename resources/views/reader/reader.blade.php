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
        .chapterName {
            text-align: center;
        }

        .chapter-list {
            list-style: none;
        }

        .chapter-list a:link,
        .chapter-list a:visited {
            text-decoration: none;
            color: black;
        }


        a:hover {
            color: rgb(38, 113, 181);
            transition: all 0.3s;
        }

    </style>
    <script>
        const fontSizeRange = document.getElementById('font-size-range');
        const lineHeightRange = document.getElementById('line-height-range');
        const textColorRange = document.getElementById('chapters-text-color-input');

        const chapters = document.getElementById('chapters');

        fontSizeRange.addEventListener('input', function () {
            const fontSize = fontSizeRange.value + 'px';
            chapters.style.fontSize = fontSize;
        });

        textColorRange.addEventListener('input', function () {
            const color = textColorRange.value;
            chapters.style.color = color;
        });

        lineHeightRange.addEventListener('input', function () {
            const lineHeight = lineHeightRange.value;
            chapters.style.lineHeight = lineHeight;
        });
    </script>

@endsection
