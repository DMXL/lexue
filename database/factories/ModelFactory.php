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

$factory->define(App\Models\User\Student::class, function () {
    $faker = Faker\Factory::create('zh_CN');
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\User\Teacher::class, function () {
    $faker = Faker\Factory::create('zh_CN');
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'teaching_since' => $faker->dateTime,
        'description' => $faker->text,
        'enabled' => $faker->boolean(80),
    ];
});

$factory->define(App\Models\Course\Lecture::class, function (Faker\Generator $faker) {
    $randomNumber = $faker->unique()->randomNumber(3, true);
    $randomNumber = (string) $randomNumber;
    $teacher_id = (int) $randomNumber[0];
    $days = (int) $randomNumber[1];
    $time_slot_id = (int) $randomNumber[2] + 1;

    return [
        'teacher_id' => $teacher_id,
        'student_id' => mt_rand(1, \App\Models\User\Student::count()),
        'date' => \Carbon::today()->addDays($days),
        'time_slot_id' => $time_slot_id
    ];
});


$factory->define(App\Models\Teacher\OffTime::class, function (Faker\Generator $faker) {
    return [
        'teacher_id' => mt_rand(1, \App\Models\User\Teacher::count()),
        'date' => \Carbon::today()->addDays(mt_rand(1,7)),
        'all_day' => $all_day = $faker->boolean(20),
        'time_slot_id' => $all_day ? null : mt_rand(1, \App\Models\Course\TimeSlot::count()),
    ];
});