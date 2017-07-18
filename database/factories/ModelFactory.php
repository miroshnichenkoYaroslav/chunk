<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Chunk::class, function (Faker\Generator $faker) {
   return [
       'id' => '0481E31883BA4F199ABB5DD19A4B0169',
       'site_id' => '907',
       'type' => 1,
       'body' => "0538681A07E04232B31995A17FBC1CBB
1
91
1
0
0
0
0
0
0
13.05.2013
13.05.2013
1
2
0
0
0
0
0





"];
});
