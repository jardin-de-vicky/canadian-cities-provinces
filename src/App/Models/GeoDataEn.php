<?php

namespace Jdv\Geo\App\Models;

class GeoDataEn extends GeoData
{
    protected $table = 'data_en';

    /**
     * French version
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function french()
    {
        return $this->hasOne(GeoDataFr::class,'code_id','code_id');
    }
}
