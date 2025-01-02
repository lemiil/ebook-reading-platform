<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorStoreRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user/user');
    }

}
