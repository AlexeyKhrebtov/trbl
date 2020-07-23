<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
    protected $fillable = ['title', 'location_km', 'location_piket', 'sector_id', 'lat', 'lng', 'comment'];

    // Привязка к ящику
    public function sector()
    {
        return $this->belongsTo('\App\Sector');
    }

    // К одному шкафу относится несколько камер
    public function cameras()
    {
        return $this->hasMany('\App\Camera');
    }
}
