<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Sector
 *
 * @property int $id
 * @property string $title Название опорного пункта
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $inventory_number Инвентарный номер
 * @property string|null $object_location Местонахождение объекта
 * @property string|null $region Регион
 * @property string|null $route_part ПЧ
 * @property string|null $fio ФИО
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Cabinet[] $cabinets
 * @property-read int|null $cabinets_count
 * @method static \Illuminate\Database\Eloquent\Builder|Sector newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sector newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sector query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereFio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereInventoryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereObjectLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereRoutePart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Sector extends Model
{
    protected $fillable = ['title', 'comment', 'inventory_number', 'object_location', 'region', 'route_part', 'fio'];

    // Связь с ящиками
    public function cabinets()
    {
        return $this->hasMany(Cabinet::class);
    }
}
