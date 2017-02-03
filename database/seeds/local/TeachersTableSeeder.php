<?php

namespace Database\Seeds\Local;

use App\Models\User\Teacher;
use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('zh_CN');

        \DB::table('teachers')->insert([
            'name' => $faker->name,
            'email' => config('auth.test.email'),
            'password' => bcrypt(config('auth.test.password')),
            'description' => $faker->text,

        ]);

        factory(Teacher::class, 20)->create();
    }
}
