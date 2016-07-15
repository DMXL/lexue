<?php

use Illuminate\Database\Seeder;

class LabelTeacherPivotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = \App\Models\User\Teacher::all();
        $labels = \App\Models\Teacher\Label::all();
        foreach ($teachers as $teacher) {
            $labels = $labels->random(2);
            DB::table('label_teacher')->insert([
                'teacher_id' => $teacher->id,
                'label_id' => $labels->first()->id,
            ]);

            DB::table('label_teacher')->insert([
                'teacher_id' => $teacher->id,
                'label_id' => $labels->last()->id,
            ]);
        }
    }
}
