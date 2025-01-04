<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['parent_comment_id', 'content', 'user_id', 'review_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent_comment()
    {
        $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
