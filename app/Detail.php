<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Detail
 *
 * @property int $id
 * @property string $name Название, модель конкретного оборудования
 * @property int $sheet_id
 * @property int $equipment_id
 * @property int $work_id
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Equipment $equipment
 * @property-read \App\Sheet $sheet
 * @property-read \App\Work $work
 * @method static \Illuminate\Database\Eloquent\Builder|Detail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Detail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Detail query()
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereEquipmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereSheetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereWorkId($value)
 * @mixin \Eloquent
 */
class Detail extends Model
{
    protected $fillable = ['name', 'sheet_id', 'equipment_id', 'work_id', 'comment'];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function sheet()
    {
        return $this->belongsTo(Sheet::class);
    }
}
