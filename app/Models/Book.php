<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = ['title', 'description', 'year', 'author_id'];


    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function cover()
    {
        return $this->hasOne(BookCover::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function files()
    {
        return $this->hasMany(BookFile::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


}
