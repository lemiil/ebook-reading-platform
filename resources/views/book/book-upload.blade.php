@extends('layouts.main')

@section('title')
    Books Main
@endsection
@section('content')

    <form action="{{ route('book.upload') }}" method="POST" enctype="multipart/form-data"
          class="p-4 border rounded bg-light shadow-sm">
        @csrf
        <div class="mb-3">
            <label class="form-label text-muted">
                Заполнение полей с автором, названием, жанрами и описанием не является обязательным, но рекомендуется.
                Если в книге отсутствуют необходимые метаданные, вы получите ошибку.
            </label>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Название</label>
            <input type="text" name="title" class="form-control" id="title" maxlength="255"
                   placeholder="Введите название книги">
        </div>

        <div class="mb-3">
            <div class="formf" style="display: flex; justify-content: space-between">
                <label for="author" class="form-label">Автор</label>
                <a href="#" target="_blank">Добавить нового автора</a>
            </div>
            @livewire('show-authors')
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea name="description" class="form-control" id="description" rows="4" maxlength="2048"
                      placeholder="Введите описание книги"></textarea>
        </div>

        <div class="mb-3">
            <label for="genres" class="form-label">Жанры</label>
            <div class="ps-3">
                <div class="row g-3">
                    @foreach($genres as $genre)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="form-check">
                                <input type="checkbox" name="genres[]" id="genre-{{ $genre->id }}"
                                       class="form-check-input" value="{{ $genre->id }}">
                                <label class="form-check-label" for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="formf" style="display: flex; justify-content: space-between">
            <div class="mb-3">
                <label for="fb2File" class="block text-gray-700">FB2:</label>
                <input type="file" name="book[]" id="fb2File" class="border rounded w-full py-2 px-3" accept=".fb2"
                >
            </div>
            <div class="mb-3">
                <label for="epubFile" class="block text-gray-700">Epub:</label>
                <input type="file" name="book[]" id="epubFile" class="border rounded w-full py-2 px-3" accept=".epub"
                >
            </div>
            <div class="mb-3">
                <label for="pdfFile" class="block text-gray-700">PDF:</label>
                <input type="file" name="book[]" id="pdfFile" class="border rounded w-full py-2 px-3" accept=".pdf"
                >
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Загрузить</button>
    </form>


    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session()->has('bookisuploaded'))
        <p style="color: green">Книга успешно загружена. Вы молодец.</p>
    @endif


    <h1 style="font-size: 5em">AMERICA YA :D</h1>

    <div style="white-space:pre">
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣀⣀⣀⣀⣤⣤⣤⣤⣤⣤⣤⣤⣤⣀⣀⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣀⣤⣴⣶⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣶⣶⣤⣀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣠⣴⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣦⣄⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣠⣶⣿⢿⡿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⢿⣿⢿⣿⢿⡿⣿⡿⣿⣿⣷⣄⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣾⣿⣯⣟⣯⣿⣿⣽⣾⣿⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⡟⣡⢺⡆⠙⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣿⣷⣻⣯⣿⣷⣆⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⢀⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠟⢹⣿⣿⡿⢋⠞⠃⠀⣷⠀⠈⠻⣿⣿⣿⣿⠛⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣇⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣟⣡⣿⣿⡿⠧⠤⣾⡿⢋⠤⠊⠀⠀⠀⢸⡄⠀⠀⠈⠻⣿⣿⡦⠬⠽⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡆⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⣿⣿⣿⣿⣿⣿⠟⠁⠀⣸⣿⣯⣤⣤⣼⣏⡠⠎⠀⠀⠀⠀⠀⠈⢷⠀⠀⠀⠀⣈⣻⣷⣤⣤⣬⣻⣧⠙⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⣼⣿⣿⣿⣿⣿⣿⡿⠋⢀⣴⢾⢏⣿⣿⣿⣿⣿⣮⣅⠀⠀⠀⠀⠀⠀⠀⠘⠙⠀⠀⠀⣩⣵⣿⣿⣿⣷⣮⡙⢳⣦⠻⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⣿⣿⣿⣿⣿⣿⡿⠃⢠⣿⠁⢠⣿⣿⣿⣿⣿⣿⣿⣿⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢰⣿⣿⣿⣿⣿⣿⣿⣷⠀⢻⣧⠈⣿⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⣿⣿⣿⣿⣿⣿⡇⠀⢹⣿⠀⢸⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⣿⣿⣿⣿⣿⣿⠀⢸⣿⠀⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⢀⣿⣿⣿⣿⣿⣿⣷⠀⠀⠁⠀⠈⢷⣤⣼⣿⣿⣿⠿⠗⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠘⠧⢤⣾⣿⣿⣿⣿⠟⠀⠘⠉⠀⣿⣿⣿⣿⣿⣿⣿⡟⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⢰⣿⣿⣿⣿⣿⣿⣿⠆⠀⠀⠀⠀⠀⠈⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢠⣶⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢹⣿⣿⣿⣿⣿⣿⣿⣿⣿⡆
        ⠀⠀⠀⠀⠀⠀⢸⣿⣿⣿⣿⣿⣿⣿⡆⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣄⣀⣀⠀⣁⢐⣀⣠⣄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣸⣿⣿⣿⣿⣿⣿⣿⣿⣿⡇⠀
        ⠀⠀⠀⠀⠀⠀⢸⣿⣿⣿⣿⣿⣿⣿⣿⣦⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣾⠿⠟⠉⠋⠉⠋⠙⠛⢿⡇⠀⠀⠀⠀⠀⠀⠀⣀⢀⣠⣴⣿⣿⣿⣿⣿⣿⣿⣿⣿⠁⠀⠀
        ⠀⠀⠀⠀⠀⠀⢸⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣦⣤⣀⣀⠀⠀⠀⠀⠀⠀⠙⣦⣀⡆⠈⡄⠀⣘⣠⡞⠁⠀⠀⢀⡀⣄⣶⣶⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⢸⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣶⣶⣀⣰⣀⢈⠙⠛⠛⠛⠛⠋⠉⣀⣶⣰⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⣸⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠿⢛⣧⠉⠉⠙⠒⠛⠛⠛⠚⠛⠉⠉⢰⡿⠿⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⣼⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⢿⣿⣿⡿⠟⠋⠁⠰⣯⠟⠀⠀⠀⠀⠄⠀⠀⠀⠀⠀⠄⢺⣡⡆⠀⠈⠻⢿⡛⢹⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠿⠟⠊⠉⠀⠀⠀⠀⠀⠀⢹⡀⠀⠈⠑⠲⢤⣄⣂⣈⣐⣀⣀⣠⣟⣀⠤⠔⠒⠀⠀⠉⠛⢿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠘⣿⣿⣿⣿⣿⣿⣿⣯⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⢷⡒⣒⠲⣒⢒⢲⣶⡒⠖⡲⢶⡞⠁⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠘⣿⣿⣿⣿⣿⣿⣿⡄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⣷⢠⣣⠔⡊⠖⢫⠘⡴⣱⠏⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣿⣿⣿⣿⣿⣿⣿⡟⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⣨⣿⣇⢻⣿⣿⣿⣿⡢⣀⠀⠀⠀⠀⠀⣀⣀⣠⡀⠀⠈⣧⠳⡘⠴⡉⢆⠽⣿⠋⠀⠀⠀⠀⣀⡀⠀⠀⠀⠀⣼⣿⣿⣿⣿⢛⣿⠿⡄⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⢄⡾⣣⢁⡛⢣⢉⡻⡿⢿⣷⢦⣉⠓⢒⣊⣭⡭⢀⡏⠀⠀⠀⠈⢳⣱⡢⠑⡌⡿⠁⠀⠀⠀⠀⢀⡇⠨⣭⣖⠢⣼⣿⣿⠿⠋⣄⣾⠏⡒⣽⣦⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⣠⡟⢚⢄⡒⢌⢂⠣⡑⠤⡃⢍⠣⡌⢍⣃⢲⣏⡀⠸⠤⣀⣀⠀⠀⠀⠹⣦⠣⣼⠃⠀⢀⣀⡤⠤⠚⢁⣀⣷⠄⢿⡟⢫⢁⠎⡱⢌⠡⢃⠜⣘⡹⣇⠀⠀⠀
        ⠀⠀⠀⠀⣰⠏⣷⡃⢆⡘⠤⢃⣌⡇⠖⡩⢌⠢⣑⠊⡔⢢⢒⠩⣉⠓⡒⠦⠭⠭⢥⣒⣚⣻⣗⣈⠭⠥⢖⢒⡚⠩⡍⡒⢤⡉⠆⡍⢒⠌⡒⣡⢊⡴⢃⠜⣠⢑⡼⠀⠀⠀
        ⠀⠀⠀⣰⢫⢰⣉⣿⡌⣴⣁⢣⣼⡏⡜⢰⣈⢱⢠⢩⣐⢡⢊⢱⢠⡍⣰⢉⡜⣤⢓⢸⣏⣀⣀⣿⡘⢢⢡⡒⣌⡑⣆⡑⢢⣌⢱⣈⣬⡘⣤⡁⣎⡟⡌⢢⢡⣾⢃⠀⠀⠀
        ⠀⠀⢰⡟⡏⠷⡙⢎⣿⡶⡉⢇⣿⡷⢙⠳⡉⠇⡎⢳⠉⢇⢋⠞⢳⢁⠳⠞⡁⢇⠞⡸⢹⡟⣿⡏⢇⡎⠷⡙⢎⡹⢈⡹⢃⠞⡰⣉⠆⢳⠆⢳⡘⣿⡁⡏⣾⠇⢏⠀⠀⠀
        ⠀⢀⡾⣥⢋⠴⡁⠆⣿⣷⣱⣿⣻⡇⢎⠰⡁⢎⠰⡁⢎⠢⢌⡘⠄⡎⠱⡨⢑⠌⡢⠅⣿⡇⣻⣏⠦⡘⠰⡉⠆⡔⢣⢐⡡⢊⠔⡰⢨⡁⢎⡡⢘⣿⣷⣼⡟⣌⠢⠀⠀⠀
        ⠀⢸⢇⠹⢌⠢⢅⠓⢾⣟⡿⣷⣿⠇⡊⢔⠡⡊⢔⠡⡊⠔⢢⠘⡰⢈⡱⢐⡉⢆⠡⢍⣿⢦⢙⣿⢂⡍⠱⡘⠌⡔⢡⢂⠒⡡⢊⠔⡡⡘⢄⡒⡡⣿⣿⣿⠒⡄⢣⠀⠀⠀
        ⠀⣿⢂⠣⢌⠣⡘⢌⠺⣿⣽⢻⣿⢀⠓⡌⢒⠡⢊⠒⡡⡉⢆⡑⢢⢁⠦⢡⠘⠤⣉⢺⣟⢸⡌⣿⡆⡌⢱⠈⡜⢠⠃⡌⢒⠡⢊⠔⡡⡘⢄⠆⡱⣿⢯⡽⢃⠜⡠⠀⠀⠀
        ⢠⡇⢎⢂⠧⢌⠱⡈⠜⣿⣞⣯⡗⢨⡘⠤⢃⠥⢃⡱⠤⡑⢢⠘⡄⡊⠔⡡⢊⠔⡤⢻⡏⡤⡇⢿⡧⡘⢄⠣⡘⢄⠣⡘⠤⡉⢆⠚⠤⡑⢊⡔⢡⣿⣻⡏⠴⡘⠰⠀⠀⠀
        ⣼⠓⡌⡒⢌⣂⠣⡉⢆⡹⢯⣷⡏⠔⡨⢒⡉⠆⠥⢂⡱⢈⠆⡱⠠⢅⠓⡄⢣⠘⠤⣿⡇⢇⡹⢸⣷⢁⠎⡰⢁⠎⡰⢁⡒⢡⠊⡜⢠⠃⡥⠘⠤⣿⣳⡟⠤⡑⢃⠀⠀⠀
    </div>
@endsection
