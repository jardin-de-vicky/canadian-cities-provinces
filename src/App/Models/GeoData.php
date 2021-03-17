<?php

namespace Jdv\Geo\App\Models;

use Illuminate\Database\Eloquent\Builder;

class GeoData extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    public $timestamps = false;


    /**
     * Filter cities
     *
     * @param Builder $query
     * @return $this
     */
    public function scopeCities(Builder $query)
    {
        return $query->where('concise_code','CITY');
    }

}
