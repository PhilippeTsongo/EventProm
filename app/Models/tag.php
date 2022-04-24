<?php

namespace App\Models;

use App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    //  Relationship between TAG AND EVENT
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
