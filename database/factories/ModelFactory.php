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

$factory->define(App\Models\Users\Student::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Users\Teacher::class, function (Faker\Generator $faker) {
    $surnames = collect(explode(',', config('faker.surnames')));
    $chars = collect(explode(',', config('faker.givennames')));
    $words = collect(explode(',', config('faker.words')));

    // generate name
    $surname = $surnames->random();
    $givenname = $chars->random();
    if ($faker->boolean(60)) {
        $givenname .= $chars->random();
    }

    // generate description
    $description = "";
    $numberOfSentences = mt_rand(2,4);
    for ($i = 0; $i < $numberOfSentences; $i++) {
        $sentence = "";
        $numberOfSegments = mt_rand(2,4);
        for ($j = 0; $j < $numberOfSegments; $j++) {
            $numberOfWords = mt_rand(3,5);
            $sentence .= implode($words->random($numberOfWords)->toArray()) . "，";
        }
        $description .= rtrim($sentence,'，') . "。";
    }
    
    return [
        'name' => $surname . $givenname,
        'description' => $description
    ];
});