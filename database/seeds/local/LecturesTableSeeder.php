<?php

namespace Database\Seeds\Local;

use Illuminate\Database\Seeder;

class LecturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('zh_CN');

        \DB::table('lectures')->insert([
            'description' => $faker->text

        ]);

        factory(\App\Models\Course\Lecture::class, 50)->create();
    }
}
