<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Gradebook::all()->each(function(App\Gradebook $gradebook) {	
            $gradebook->students()->saveMany(factory(App\Student::class, 10)->make());
        });
    }
}
