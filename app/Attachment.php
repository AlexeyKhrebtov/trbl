<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * App\Attachment
 *
 * @property int $id
 * @property string $filename
 * @property string $path
 * @property string $ext
 * @property int $size
 * @property int $attachable_id
 * @property string $attachable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $attachable
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereAttachableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereAttachableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Attachment extends Model
{
    protected $fillable = [
        'filename', 'path', 'ext', 'size'
    ];

    /**
     * Получить принадлежащую модель аттачмента
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function attachable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Формируем ссылку
     * @return string
     */
    public function getLinkAttribute(): string
    {
        return Storage::url('attach/'. $this->attributes['path']);
    }

    public function getHowLongAttribute(): string
    {
        setlocale(LC_ALL, 'ru_RU.utf8');
        Carbon::setLocale('ru');
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']))->diffForHumans();
    }

    public function getSizeForHumanAttribute(): string
    {
        $bytes = $this->attributes['size'];
        $i = floor(log($bytes, 1024));
        return round($bytes / pow(1024, $i), [0,0,2,2,3][$i]).' '.['B','kB','MB','GB','TB'][$i];
    }
}
