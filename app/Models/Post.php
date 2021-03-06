<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use App\Scopes\ReverseScope;

class Post extends Model
{
    use HasFactory;

    // protected $fillable=['body', 'user_id'];
    protected $guarded=[];

    protected static function booted()
    {
        static::addGlobalScope(new ReverseScope);
    }

    public function likes(){
        return $this->belongsToMany(User::class, 'likes','post_id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
