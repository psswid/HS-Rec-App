<?php

namespace App\Repositories;

use App\Models\Planet;
use App\Repositories\BaseRepository;

/**
 * Class PlanetRepository
 * @package App\Repositories
 * @version July 3, 2021, 11:48 am UTC
*/

class PlanetRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return Planet::class;
    }
}
