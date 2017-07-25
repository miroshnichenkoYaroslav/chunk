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

$factory->define(App\ReChunk::class, function (Faker\Generator $faker) {
    return [
        'id' => '0481E31883BA4F199ABB5DD19A4B0169',
        'site_id' => '907',
        'type' => 1,
        'body' => '{"pageId":"0B395229691F49ADB8454984CA818F45","type":"1","properties":{"datePublish":"0","addToContent":false,"onlyFirstPart":false},"nested":"0","allLevelsDown":"0","rowsLimit":"0","order":"0","dateFromCheck":"0","dateToCheck":"0","dateFrom":"30.04.2013","dateTo":"30.04.2013","pagination":"0","rowsPerPage":"0","category":"0","linkType":"0","nameLink":false,"iconWidth":false,"iconHeight":false,"listPages":false,"file":false}'
    ];
});

$factory->define(App\Chunk::class, function (Faker\Generator $faker) {
   return [
       'id' => '0481E31883BA4F199ABB5DD19A4B0169',
       'site_id' => '907',
       'type' => 1,
       'body' => "0B395229691F49ADB8454984CA818F45
1
0
0
0
0
0
0
0
0
30.04.2013
30.04.2013
0
0
0
0
0
0
0




"];
});
