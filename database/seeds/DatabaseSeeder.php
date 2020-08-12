<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             UserSeeder::class, // пользователи
             SectorSeeder::class, // создать участки
             CabinetSeeder::class, // шкафы
             CameraSeeder::class, // камеры
             EquipmentSeeder::class, // оборудование
             WorkSeeder::class, // список выполняемых работ с оборудованием
         ]);
    }
}
