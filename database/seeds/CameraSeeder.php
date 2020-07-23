<?php

use App\Cabinet;
use App\Camera;
use Illuminate\Database\Seeder;

class CameraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Camera::class, 48)->make()->each(function($camera){
            $cabinet_id = intval(ceil ($camera->location_km / 10));
            $cabinet = Cabinet::find($cabinet_id);
            if (!$cabinet) {
                $cabinet = Cabinet::find(1);
            }

            if ($cabinet && isset($cabinet->id)) {
                $camera->cabinet_id = $cabinet->id;
            }

            $camera->save();
        });
    }
}
