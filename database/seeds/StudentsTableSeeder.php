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
        DB::table('students')->insert([
            'name' => \App\Services\ChineseFaker::name(),
            'email' => config('auth.test.email'),
            'password' => bcrypt(config('auth.test.password')),
        ]);

        factory(Student::class, 20)->create();
    }
}
