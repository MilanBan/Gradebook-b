<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Gradebook::all()->each(function(App\Gradebook $gradebook) {	
            $gradebook->comments()->saveMany(factory(App\Comment::class, 5)->make());
        });
    }
}
