<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class CharacterSpecies
 *
 * @package App\Models
 * @property integer $character_remote_id
 * @property integer $type_remote_id
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterSpecies newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterSpecies newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterSpecies query()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterSpecies whereCharacterRemoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterSpecies whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterSpecies whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterSpecies whereTypeRemoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterSpecies whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CharacterSpecies extends Pivot
{
    protected $table = 'character_species';

}
