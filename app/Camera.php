<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    protected $fillable = ['title', 'location_km', 'location_piket', 'lat', 'lng', 'comment', 'ip', 'login', 'password', 'cabinet_id'];

    // Привязка к шкафу
    public function cabinet()
    {
        return $this->belongsTo('\App\Cabinet');
    }
}
