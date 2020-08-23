<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
