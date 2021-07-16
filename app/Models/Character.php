<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Character
 *
 * @package App\Models
 * @property integer $remote_id
 * @property string $name
 * @property integer $mass
 * @property string $skin_color
 * @property string $birth_year
 * @property string $died_year
 * @property string $culture
 * @property string $gender
 * @property integer $homeworld_id
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Film[] $films
 * @property-read int|null $films_count
 * @property-read \App\Models\Planet $homeworld
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Type[] $species
 * @property-read int|null $species_count
 * @method static \Database\Factories\CharacterFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Character newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Character newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Character query()
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereBirthYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereCulture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereDiedYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereHomeworldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereMass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereRemoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereSkinColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereUpdatedAt($value)
 * @mixin Model
 */
class Character extends Model
{
    use HasFactory;

    public $fillable = [
        'remote_id',
        'name',
        'mass',
        'skin_color',
        'birth_year',
        'died_year',
        'culture',
        'gender',
        'homeworld_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function films()
    {
        return $this->belongsToMany(
            Film::class,
            CharacterFilms::class,
            'character_remote_id',
            'film_remote_id' )
        ->using(CharacterFilms::class)
        ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function species()
    {
        return $this->belongsToMany(
            Type::class,
            CharacterSpecies::class,
            'character_remote_id',
            'type_remote_id' )
        ->using(CharacterSpecies::class)
        ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function homeworld()
    {
        return $this->belongsTo(Planet::class, 'homeworld_id', 'remote_id');
    }
}
