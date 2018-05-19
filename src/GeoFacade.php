<?php
namespace Jdv\Geo;

use Illuminate\Support\Facades\Facade;

class GeoFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CanadaGeo';
    }
}