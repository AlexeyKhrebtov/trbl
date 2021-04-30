<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Equipment
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Equipment extends Model
{
    protected $fillable = ['title'];
}
