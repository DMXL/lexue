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

use App\Services\ChineseFaker;

$factory->define(App\Models\User\Student::class, function (Faker\Generator $faker) {
    return [
        'name' => ChineseFaker::name(),
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\User\Teacher::class, function (Faker\Generator $faker) {
    return [
        'name' => ChineseFaker::name(),
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'teaching_since' => $faker->dateTime,
        'description' => ChineseFaker::text()
    ];
});

$factory->define(App\Models\Course\Lecture::class, function (Faker\Generator $faker) {
    do {
        $randomNumber = $faker->unique()->randomNumber(3, true);
        $teacher_id = (int) floor($randomNumber / 100);
        $day_number = (int) floor(($randomNumber % 100) / 10);
        $hour_number = $randomNumber % 10 + 9;
    } while (
        $day_number < 1
        OR $day_number >7
        OR $hour_number > 16
    );

    return [
        'teacher_id' => $teacher_id,
        'student_id' => mt_rand(1, \App\Models\User\Student::count()),
        'start_at' => \Carbon\Carbon::today()->addDays($day_number)->addHours($hour_number)
    ];
});


$factory->define(App\Models\Teacher\OffTime::class, function (Faker\Generator $faker) {
    return [
        'teacher_id' => mt_rand(1, \App\Models\User\Teacher::count()),
        'time' => \Carbon\Carbon::today()->addDays(mt_rand(1,7))->addHours(mt_rand(9,16)),
        'all_day' => $faker->boolean(20)
    ];
});