<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Work
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Work newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Work newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Work query()
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Work extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'work'; // fix Laravel пытается искать таблицу works

    protected $fillable = ['title'];
}
