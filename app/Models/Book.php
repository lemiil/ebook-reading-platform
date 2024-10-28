<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    use HasFactory;
    protected $fillable = ['title', 'author', 'path', 'description', 'format'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

}
