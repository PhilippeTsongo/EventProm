<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'starts_at' => 'datetime',
        'end_date' => 'datetime',
    ];

    //Relationship between EVENT AND USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relationship between EVENT AND USER
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
    //Relationship between EVENT AND IMAGE
    public function image()
    {
        return $this->hasOne(Image::class);
    }

    //Relationship between EVENT AND COMMENT
    public function comments()
    {
        return $this->hasMany(Comment::class);
    } 
    

}
