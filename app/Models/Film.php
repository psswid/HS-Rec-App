<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Film
 *
 * @package App\Models
 * @property integer $remote_id
 * @property string $name
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Film newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Film newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Film query()
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereRemoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Film extends Model
{
    public $fillable = [
        'remote_id',
        'name',
    ];
}
