<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Teacher;
use App\Gradebook;
use Faker\Generator as Faker;

$factory->define(Teacher::class, function (Faker $faker) {
    $userIds = User::all()->pluck('id')->toArray();
    $gradebookIds = Gradebook::all()->pluck('id')->toArray();
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'user_id' => $faker->randomElement($userIds),
        'gradebook_id' => $faker->randomElement($gradebookIds),
    ];
});
