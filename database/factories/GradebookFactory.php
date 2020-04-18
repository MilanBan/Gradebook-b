<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Teacher;
use App\Gradebook;
use Faker\Generator as Faker;

$factory->define(Gradebook::class, function (Faker $faker) {
    $teacherIds = Teacher::all()->pluck('id')->toArray();
    return [
        'name' => $faker->numerify('Class ##'),
        'teacher_id' => $faker->randomElement($teacherIds),
    ];
});
