<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    use HasFactory;
    protected $fillable = ['title', 'author', 'description', 'year'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function authors() {
        return $this->belongsTo(Author::class);
    }

    public function files()
    {
        return $this->hasMany(BookFile::class);
    }

}
