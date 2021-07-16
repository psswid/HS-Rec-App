<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class CharacterFilms
 *
 * @package App\Models
 * @property integer $character_remote_id
 * @property integer $film_remote_id
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterFilms newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterFilms newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterFilms query()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterFilms whereCharacterRemoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterFilms whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterFilms whereFilmRemoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterFilms whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterFilms whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CharacterFilms extends Pivot
{
    protected $table = 'character_films';

}
