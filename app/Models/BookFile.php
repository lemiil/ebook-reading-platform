<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookFile extends Model
{
    protected $fillable = ['file_path', 'format'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
