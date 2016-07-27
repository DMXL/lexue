<?php

use App\Models\User\Student;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        DB::table('students')->insert([
            'name' => $faker->name,
            'email' => config('auth.test.email'),
            'password' => bcrypt(config('auth.test.password')),
        ]);

        factory(Student::class, 20)->create();
    }
}
