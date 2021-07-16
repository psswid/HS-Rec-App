<?php

namespace App\Repositories;

use App\Models\Character;
use App\Repositories\BaseRepository;

/**
 * Class CharacterRepository
 * @package App\Repositories
 * @version July 3, 2021, 11:48 am UTC
*/

class CharacterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'gender',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Character::class;
    }
}
