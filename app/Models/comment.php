<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'website', 'comment', 'event_id', 'email' ];

    //Relationship between COMMENT AND EVENT
    public function event()
    {
        return $this->belongsTo(Event::class);
    } 
}
