<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Sheet
 *
 * @property int $id
 * @property int $number Номер дефектной ведомости
 * @property string $date Дата
 * @property int $sector_id
 * @property int $status Статус ДФ, значени задается в модели
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attachment[] $attachments
 * @property-read int|null $attachments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Detail[] $details
 * @property-read int|null $details_count
 * @property-read \App\Sector $sector
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet whereSectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Sheet extends Model
{
    protected $fillable = ['number', 'date', 'sector_id', 'status'];

    protected $attributes = [
        'status' => 10,
    ];

    // Привязка к участку ОПО
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    // Привязанные детали отчета
    public function details()
    {
        return $this->hasMany(Detail::class);
    }

    // Преобразование поля "Статус"
    public function getStatusAttribute($attr)
    {
        return $this->statusOptions()[$attr] ?? null;
    }

    // Карта преобразований статуса
    public function statusOptions()
    {
        return [
            10 => 'Выявлен дефект',
            20 => 'Сформирована',
            30 => 'Подписана',
            40 => 'Передана',
            50 => 'Восстановлено',
            60 => 'Закрыто'
        ];
    }

    /**
     * Получить все вложения для ведомости
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function attachments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany('App\Attachment', 'attachable');
    }
}
