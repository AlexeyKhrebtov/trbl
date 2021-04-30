<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Cabinet
 *
 * @property int $id
 * @property string $title
 * @property int $location_km
 * @property int|null $location_piket пикет
 * @property string $lat Широта
 * @property string $lng Долгота
 * @property string|null $comment
 * @property int $sector_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Camera[] $cameras
 * @property-read int|null $cameras_count
 * @property-read \App\Sector $sector
 * @method static \Illuminate\Database\Eloquent\Builder|Cabinet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cabinet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cabinet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cabinet whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabinet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabinet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabinet whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabinet whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabinet whereLocationKm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabinet whereLocationPiket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabinet whereSectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabinet whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabinet whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
