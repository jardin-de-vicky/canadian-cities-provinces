<?php
namespace Jdv\Geo;

use Jdv\Geo\App\Models\City;
use Jdv\Geo\App\Models\Province;

/**
 * Geo routes/controllers
 *
 * Class Geo
 * @package Jdv\Geo
 */
class Geo
{
    /**
     * Get all cities
     *
     * @return array
     */
    public function getCitiesArray()
    {
        return City::all()->pluck('name','id')->toArray();
    }

    /**
     * Get all cities
     *
     * @return array
     */
    public function getProvincesArray()
    {
        return Province::all()->pluck('name','id')->toArray();
    }
}