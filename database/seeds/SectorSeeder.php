<?php

use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sector_list = collect([
            'Обухово', 'Тосно', 'Рябово', 'Любань', 'Бабино', 'Чудово', 'Гряды', 'Малая Вишера'
        ])->each(function ($item, $key) {
            $sector = factory(App\Sector::class)->make();
            $sector->title = $item;
            if (rand(0, 1)) {
                $sector->comment = '';
            }
            $sector->save();
        });

    }
}
