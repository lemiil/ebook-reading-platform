<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCover extends Model
{
    protected $fillable = ['file_path'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
