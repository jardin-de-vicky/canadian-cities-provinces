<?php

namespace Jdv\Geo\App\Console;

use Jdv\Geo\App\Models\City;
use Jdv\Geo\App\Models\GeoDataEn;
use Jdv\Geo\App\Models\GeoDataFr;
use Jdv\Geo\App\Models\Province;
use Illuminate\Console\Command;

class GeoProceedInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geo:proceed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill the cities table';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        City::truncate();

        GeoDataEn::with('french')->cities()->chunk(500, function ($rows) {
            foreach ($rows as $row){

                $province = Province::where('name_en',$row->province)->first();

                if (is_null($province)){
                    dump($row->code_id);
                }

                City::create([
                    'name_en'       => $row->geographical_name,
                    'name_fr'       => $row->french->geographical_name,
                    'code_id'       => $row->code_id,
                    'province_id'   => $province->id,
                    'lat'           => $row->latitude,
                    'lng'           => $row->longitude,
                ]);
            }
        });
    }

}
