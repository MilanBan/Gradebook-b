<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(App\User::class, 35)->create()
            ->each(function(App\User $user) {
                $teacher = new App\Teacher();
                $teacher->firstName = $user->firstName;
                $teacher->lastName = $user->lastName;

                $user->teacher()->save($teacher);
            });
    }
}
