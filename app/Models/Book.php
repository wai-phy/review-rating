<?php

namespace App\Models;

use App\Models\User;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'content','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function rating(){
        return $this->hasMany(Rating::class,'user_id', 'id');
    }


}
