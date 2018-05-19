<?php

namespace Jdv\Geo\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Jdv\Admin\App\Models\Branch;

class City extends BaseModel
{
    protected $table = 'ca_cities';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_fr',
        'name_en',
        'code_id',
        'province_id',
        'lat',
        'lng',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('ordered', function (Builder $builder) {
            $builder->OrderedAlphabetically();
        });
    }


    /**
     * Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function branches()
    {
        return $this->hasMany(Branch::class,'city_id');
    }

    /**
     * Province
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function province()
    {
        return $this->hasOne(Province::class,'id','province_id');
    }

    /**
     * Points within distance by lat/lng
     * @param $query
     * @param $location
     * @param int $radius
     * @return mixed
     */
    public function scopeWithinMaxDistance($query, $lat, $lng, $radius = 25, $type = 'K')
    {
        $r = ($type='K') ? 6371 : 3961;
        $haversine = "($r * acos(cos(radians($lat)) 
                     * cos(radians(".$this->getTable().".lat)) 
                     * cos(radians(".$this->getTable().".lng) 
                     - radians($lng)) 
                     + sin(radians($lat)) 
                     * sin(radians(".$this->getTable().".lat))))";
        $query
            ->select('*')
            ->selectRaw("{$haversine} AS distance")
            ->selectRaw("'{$type}' AS distanceType")
            ->orderBy('distance', 'asc');

        if (env('SEARCH_POINT_RADIUS', false)) {
            $query->whereRaw("{$haversine} < ?", [$radius]);
        }

        return $query;
    }

}
