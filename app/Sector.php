<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $fillable = ['title', 'comment'];

    // Связь с ящиками
    public function cabinets()
    {
        return $this->hasMany(Cabinet::class);
    }
}
