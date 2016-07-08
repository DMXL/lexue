<?php

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
        DB::table('teachers')->insert([
            'name' => \App\Services\ChineseFaker::name(),
            'email' => config('auth.test.email'),
            'password' => bcrypt(config('auth.test.password')),
            
        ]);

        factory(Teacher::class, 20)->create();
    }
}
