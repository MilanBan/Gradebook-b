<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use App\Gradebook;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    $gradebookIds = Gradebook::all()->pluck('id')->toArray();
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'gradebook_id' => $faker->randomElement($gradebookIds),
    ];
});
