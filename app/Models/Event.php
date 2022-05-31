<?php

namespace App\Models;

use App\Mail\EventCreatedMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $createdAt
 * @property string $updatedAt
 * @method static \Database\Factories\EventFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    // custom column for soft delete
    const DELETED_AT = 'deletedAt';

    // to return id as uuid
    public $incrementing = false;

    // disable auto update timestamp
    public $timestamps = false;

    // enable mass assignments
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        self::creating(function (self $model) {
            $model->id        = (string) Str::uuid();
            $model->createdAt = now()->toDateTimeString();
            $model->updatedAt = now()->toDateTimeString();
        });

        self::created(function (self $model) {
            // clear cache
            \Cache::flush();

            // send email
            \Mail::to('firdausnasir69@gmail.com')->send(new EventCreatedMail($model));
        });
    }
}
