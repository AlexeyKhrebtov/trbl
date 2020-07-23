<?php

use App\Cabinet;
use App\Sector;
use Illuminate\Database\Seeder;

class CabinetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Cabinet::class, 16)->make()->each(function ($cabinet) {
            $sector_id = intval(ceil ($cabinet->location_km / 10));
            $sector = Sector::find($sector_id);
            if (!$sector) {
                $sector = Sector::find(1);
            }

            if ($sector && isset($sector->id)) {
                $cabinet->sector_id = $sector->id;
            }
            $cabinet->save();
        });
    }
}
