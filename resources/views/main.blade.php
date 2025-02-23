@extends('layouts.main')

@section('title')
    Books!
@endsection

@section('content')
    <h1>Hello world</h1>
    <h1 style="font-size: 5em">NEW YEAR YA :D</h1>
    @if(auth()->check())
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link text-muted">
                Log Out
            </button>
        </form>
    @endif

    @if ($errors->any())
        <ul class="alert alert-danger mt-3">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </ul>
    @endif
    <div style="white-space:pre">
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⡤⣚⣯⣭⣶⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣯⣝⠢⢄⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣴⣿⢾⡿⣟⣿⣻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⢿⣿⣿⣿⣶⣭⢢⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣠⢫⣿⣽⣿⣿⣿⣿⣿⣿⡿⡟⠹⣿⣿⡿⣿⣿⣿⣿⣷⣾⣷⣏⣟⣧⠱⡄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢰⢷⣿⣿⣿⢿⣿⡿⢹⣿⠟⢡⠇⠀⢻⣿⡇⠙⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⡘⣄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣿⣿⣿⣿⠃⣿⣿⡁⡾⠫⠀⡼⠀⠀⠀⢻⣗⠀⠘⣿⡏⢿⣿⣿⣿⣿⣿⣿⣷⢸⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣸⢻⣿⣿⡏⠀⣿⣤⠽⣷⡦⡼⠁⠀⠀⣤⠤⢿⣾⣭⣈⣣⠈⢿⣿⣿⣿⣿⣿⣿⡇⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣿⣿⣿⣿⠀⣸⠏⠀⠀⠀⢹⡄⠀⠀⠀⠀⢠⡾⠉⠀⠈⠙⣦⠘⣿⣿⣿⣿⣿⣿⣿⢷⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⡗⣿⣿⣿⡃⠹⣦⠀⠀ ⣠⡾⠀⠀⠀⠀ ⠸⣧⡀⠀⠀⢀⡿⠀⣿⣿⣿⣿⣿⣿⣿⢸⡄⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣇⣿⣿⣿⡇⠀⠙⠒⠒⠛⠁⠀⠀⠀⠀⠀⠀⠙⠳⠤⠴⠚⠁⠀⣿⣿⣿⣿⣿⣿⣿⣨⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢨⣿⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣿⣿⣿⣿⣿⣿⣿⣿⡇⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⢹⣿⣿⣿⠆⠀⠀⠀⠀⢀⣤⣤⣠⣀⡤⠤⠤⢤⣀⠀⠀⠀⠀⠀⣿⣿⣿⣿⣿⣿⣿⡇⠃⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣼⣿⣿⣿⡃⠀⠀⠀⠀⡞⠀⠀⠀⠀⠀⠀⠀⠀⠈⢳⡀⠀⠀⢀⣿⣿⣿⣿⣿⣿⣿⣿⣷⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⡞⣿⣿⣿⣿⣧⡀⠀⠀⠀⣇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⡇⠀⠀⢼⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⡷⣿⣿⣿⣿⣿⣿⣶⣤⣀⠻⢀⣀⣀⣀⣀⣀⡀⠀⠀⣰⣇⣤⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣏⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣶⣦⡤⠤⠭⠟⠛⠛⢹⡿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⢿⣿⣿⣿⡟⣿⣿⣿⣏⣿⠿⠋⣽⡇⠀⠀⠀⠀⠀⣸⠇⠙⢿⣿⣿⣿⣿⣿⣿⣿⡿⢿⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⢸⡿⣿⣿⣇⠹⣿⡿⠟⠁⠀⢹⡯⣀⠀⠀⢀⡀⣰⠟⠒⠉⠀⣿⣿⣿⣿⣿⣿⣿⡇⢸⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣾⣹⣿⣿⣿⠴⠋⠀⠀⠀⠀⢸⠁⠈⠉⠉⠉⣰⠋⠀⠀⠀⢀⣿⣿⠟⢹⣿⣿⣿⢳⢸⢾⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠘⣿⡿⢻⡉⢿⡆⠀⠀⠀⠀⠀⢸⠒⠒⠒⢒⡾⠁⠀⠀⠀⠀⣸⣿⡿⠖⣿⣥⠼⣿⣿⡶⢿⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢹⣥⣾⢷⡌⠻⠶⢶⣶⠀⠀⢸⡆⠀⢠⡞⢡⣄⡀⠀⣀⣴⠟⣅⡴⠋⠁⠀⠀⠈⢻⡵⣞⠀⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣸⣽⠁⢠⠉⠛⠺⣽⢻⣄⡀⢸⡇⢠⠟⣀⣼⣷⢭⣛⣩⡾⠛⠁⠀⠀⡀⣠⡞⠓⠛⠻⣞⣆⠀⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣰⣻⣷⠀⢸⡀⠀⠀⠙⠲⣬⣉⠛⣷⣟⣋⣉⣥⠿⠀⠈⠁⡀⡀⠀⠐⢠⣼⡏⠀⠀⠀⠀⠹⣜⡆⠀⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣴⣳⠇⠘⣧⣸⠀⠀⠀⠠⢀⠀⠘⣿⢹⡟⠁⠀⠀⢀⠐⠀⠐⠀⣿⢀⢨⣾⡟⠀⠀⡀⠠⠀⠀⠘⣾⢆⠀⠀⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣴⣿⠃⠠⠀⠙⣿⡇⠀⢈⠐⠠⢀⠠⣿⣿⠀⠌⢀⠈⠀⡀⠂⠂⢈⣿⣶⣟⢯⣿⡄⠀⢀⠐⡀⠐⠀⠉⢷⡳⣄⠀⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣰⡿⠋⢀⠀⠀⢂⣽⠁⠂⠈⠄⠀⠌⢐⣿⣿⠀⠄⠈⠠⠀⠁⠠⠄⠸⣿⣿⣿⣎⠿⣷⡄⠈⠀⠁⠄⠀⢀⠈⠳⣝⢆⠀⠀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢠⠞⠟⠀⢈⠠⠀⢄⣿⣿⠀⡃⢈⠐⢀⠂⢸⣿⣿⠀⠌⠐⢀⠑⢀⣦⣴⣄⣹⣿⢿⣿⣻⡿⠛⢶⣄⣂⣠⣶⠦⢦⣄⣈⢧⡳⡀⠀
        ⠀⠀⠀⠀⠀⠀⠀⠀⣠⣤⡖⣲⣤⣶⡻⠷⠲⢶⣤⡐⢠⣿⣿⣯⠀⡐⢀⠐⡀⠂⣾⡟⣿⠀⠜⠀⢄⣢⣀⣻⣦⣄⡈⠙⢛⡿⣿⣤⣄⡀⢈⠙⠣⠀⠰⣀⢈⠍⠃⢻⣽
        ⠀⠀⠀⡠⠖⡟⠉⣿⡝⠳⢶⢦⡿⣍⢀⠒⡆⠤⠙⢿⣿⣟⣼⡇⡐⠄⡈⠰⠠⢁⣿⡹⣿⠀⠃⠌⡐⠿⣭⣍⣩⠽⠛⠋⠉⠀⠘⣎⢷⢻⡄⠌⡐⠈⠄⡀⠆⡐⠠⡈
        ⠀⠠⢊⠄⠈⠀⣸⣽⣣⡄⠈⢯⢷⠘⣧⣰⣴⣶⣼⣦⢿⣿⣽⡇⡐⠄⡂⠅⠌⠤⣿⢘⣿⠀⡩⢐⠠⢂⠄⡈⢳⣶⢒⣻⠟⠃⠀⠸⡞⡇⢿⠀⢤⠉⡐⠠⢒⠠⢁⢐
        ⠴⠁⠀⢨⡀⢠⣧⠏⠁⠀⠀⣸⣿⣇⣻⣿⣭⣷⣻⣞⣯⣞⣿⠇⡐⢡⠂⣉⠚⣰⡟⢸⡿⢀⡑⠢⢑⢂⠰⢐⢂⣿⠋⣁⣠⡶⠂⠀⣿⡇⣾⠈⣄⣢⣵⣾⣿⣿⡿⣿
        ⣤⢤⣤⣭⢭⣭⣥⣭⣭⣭⣭⣭⣭⣭⣭⣭⣭⠿⣷⢾⡷⣿⢾⡷⣼⢦⡶⣴⢶⣾⡷⢾⡷⢶⡬⣵⡈⢢⠁⢎⠤⡉⣿⡿⠋⢀⣠⣼⣿⣽⣷⣾⣾⣿⣿⣿⠟⢯⠞⠁
        ⠮⠾⠴⣮⠞⣴⢎⠶⡵⢮⠶⡵⢮⠶⢶⢶⡼⢮⡵⣮⢶⣵⢮⡶⡵⣮⡵⣮⠷⣦⡽⣧⣾⢧⡼⠾⢃⠥⡉⢆⠢⡑⣼⣿⣿⣿⣿⣿⣿⣽⣾⣽⣿⣟⣭⣿⣽⣟⠀⠀⠀⠀
    </div>
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
