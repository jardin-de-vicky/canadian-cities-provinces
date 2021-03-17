<?php

namespace Jdv\Geo\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Append custom attribute
     * @var array
     */
    protected $appends = [
        'name',
    ];


    /**
     * Order alphabetically
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOrderedAlphabetically(Builder $query)
    {
        return $query->orderBy('name_'.appLocale());
    }

    /**
     * Distinct by name
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeDistinctOnly(Builder $query)
    {
        return $query->distinct('name_'.appLocale());
    }

    /**
     * Get name
     *
     * @return mixed
     */
    public function getNameAttribute()
    {
        return $this->getAttribute('name_'.appLocale());
    }
}
