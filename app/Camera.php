<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Camera
 *
 * @property int $id
 * @property string $title
 * @property int $location_km
 * @property int|null $location_piket пикет
 * @property string $lat Широта
 * @property string $lng Долгота
 * @property string|null $comment
 * @property string|null $ip
 * @property string|null $login
 * @property string|null $password
 * @property int $cabinet_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Cabinet $cabinet
 * @method static \Illuminate\Database\Eloquent\Builder|Camera newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Camera newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Camera query()
 * @method static \Illuminate\Database\Eloquent\Builder|Camera whereCabinetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camera whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camera whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camera whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camera whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camera whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camera whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camera whereLocationKm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camera whereLocationPiket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camera whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camera wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camera whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camera whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Camera extends Model
{
    protected $fillable = ['title', 'location_km', 'location_piket', 'lat', 'lng', 'comment', 'ip', 'login', 'password', 'cabinet_id'];

    // Привязка к шкафу
    public function cabinet()
    {
        return $this->belongsTo('\App\Cabinet');
    }
}
