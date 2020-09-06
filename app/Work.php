<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
