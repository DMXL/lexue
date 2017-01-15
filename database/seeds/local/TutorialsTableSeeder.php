<?php

namespace Database\Seeds\Local;

use Illuminate\Database\Seeder;

class TutorialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Course\Tutorial::class, 50)->create();
    }
}
