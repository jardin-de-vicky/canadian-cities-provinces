<?php

namespace Jdv\Geo\App\Models;

use Illuminate\Database\Eloquent\Builder;

class Province extends BaseModel
{
    protected $table = 'ca_provinces';
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
        'code',
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
     * Get the provinces with branches only
     */
    public function scopeWithBranches(Builder $query)
    {
        return $query->whereHas('city',function(Builder $q){
           $q->has('branches');
        })->distinctOnly();
    }

    /**
     * City
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function city()
    {
        return $this->hasOne(City::class,'province_id');
    }

}
