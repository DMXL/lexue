<?php

use Illuminate\Database\Seeder;

class TimeslotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ([8,9,10,11,13,14,15,16,17,21] as $hour) {
            $time = Carbon::create(0,0,0,$hour);
            $from = $time->toTimeString();
            $to = $time->addMinutes(45)->toTimeString();
            DB::table('time_slots')->insert([
                'from' => $from,
                'to' => $to
            ]);
        }
    }
}
