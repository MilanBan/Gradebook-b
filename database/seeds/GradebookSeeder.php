<?php

use Illuminate\Database\Seeder;

class GradebookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Teacher::all()->each(function(App\teacher $teacher) {	
            $teacher->gradebook()->saveMany(factory(App\Gradebook::class, 1)->make());
        });
    }
}
