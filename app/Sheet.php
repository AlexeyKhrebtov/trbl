<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
}
