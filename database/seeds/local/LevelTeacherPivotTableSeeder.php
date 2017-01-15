<?php

namespace Database\Seeds\Local;

use Illuminate\Database\Seeder;

class LevelTeacherPivotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = \App\Models\User\Teacher::all();
        $levels = \App\Models\Teacher\Level::all();
        foreach ($teachers as $teacher) {
            \DB::table('level_teacher')->insert([
                'teacher_id' => $teacher->id,
                'level_id' => $levels->random()->id,
            ]);
            \DB::table('level_teacher')->insert([
                'teacher_id' => $teacher->id,
                'level_id' => $levels->random()->id,
            ]);
        }
    }
}
