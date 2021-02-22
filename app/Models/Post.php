<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
