<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $fillable = ['title', 'comment', 'inventory_number', 'object_location', 'region', 'route_part', 'fio'];

    // Связь с ящиками
    public function cabinets()
    {
        return $this->hasMany(Cabinet::class);
    }
}
