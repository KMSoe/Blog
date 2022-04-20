<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $appends = ['numOfComments', 'numOfReactions'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function getNumOfCommentsAttribute()
    {
        return $this->comments()->count();
    }
    public function getNumOfReactionsAttribute()
    {
        return $this->reactions()->count();
    }
}
