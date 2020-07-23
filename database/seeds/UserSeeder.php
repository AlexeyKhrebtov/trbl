<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        if (! \App\User::where('email', 'alexeymegaex@gmail.com')->get()->toArray()) {
            $admin_user = factory(App\User::class)->make();
            $admin_user->name = 'Админ';
            $admin_user->email = 'alexeymegaex@gmail.com';
            $admin_user->password = '$2y$10$/9JkhxqQbnRstWLbaXXW9Oa0FwaZrZg3dUXNT43v8Ym0YcPrbrMk6'; // password
            $admin_user->save();
        }

        if (!\App\User::where('email', 'filippow87@mail.ru')->get()->toArray()) {
            $admin_user = factory(App\User::class)->make();
            $admin_user->name = 'Алексей Филиппов';
            $admin_user->email = 'filippow87@mail.ru';
            $admin_user->password = '$2y$10$/9JkhxqQbnRstWLbaXXW9Oa0FwaZrZg3dUXNT43v8Ym0YcPrbrMk6'; // password
            $admin_user->save();
        }

        // factory(\App\User::class, 3)->create();
    }
}
