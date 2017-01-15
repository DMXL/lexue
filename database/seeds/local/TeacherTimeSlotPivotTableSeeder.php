<?php

namespace Seeds\Local;

use Illuminate\Database\Seeder;

class TeacherTimeSlotPivotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = \App\Models\User\Teacher::all();
        $timeslots = \App\Models\Course\TimeSlot::all();
        foreach ($teachers as $teacher) {
            $times = $timeslots->random($timeslots->count() - mt_rand(0,4));
            foreach ($times as $time)
            DB::table('teacher_time_slot')->insert([
                'teacher_id' => $teacher->id,
                'time_slot_id' => $time->id,
            ]);
        }
    }
}
