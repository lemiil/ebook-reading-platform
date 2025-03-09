@extends('layouts.main')

@section('title')
    Author upload
@endsection

@section('content')

    <div class="container w-50">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card shadow-sm border-0 rounded">
                    <form action="{{ route('author.upload') }}" method="POST" enctype="multipart/form-data"
                          class="form-control">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="title" maxlength="255">
                        </div>


                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="4"
                                      maxlength="2048"></textarea>
                        </div>

                        <button type="submit" class="btn mb-3 btn-dark">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
