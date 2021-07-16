<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Planet
 *
 * @package App\Models
 * @property integer $remote_id
 * @property string $name
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Planet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Planet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Planet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Planet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Planet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Planet whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Planet whereRemoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Planet whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Planet extends Model
{
    public $fillable = [
        'remote_id',
        'name',
    ];
}
