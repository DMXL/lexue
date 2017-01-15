<?php

namespace Seeds\Staging;

use Illuminate\Database\Seeder;

class TimeSlotsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('time_slots')->delete();
        
        \DB::table('time_slots')->insert(array (
            0 => 
            array (
                'id' => 1,
                'start' => '08:00:00',
                'end' => '08:45:00',
            ),
            1 => 
            array (
                'id' => 2,
                'start' => '09:00:00',
                'end' => '09:45:00',
            ),
            2 => 
            array (
                'id' => 3,
                'start' => '10:00:00',
                'end' => '10:45:00',
            ),
            3 => 
            array (
                'id' => 4,
                'start' => '11:00:00',
                'end' => '11:45:00',
            ),
            4 => 
            array (
                'id' => 5,
                'start' => '13:00:00',
                'end' => '13:45:00',
            ),
            5 => 
            array (
                'id' => 6,
                'start' => '14:00:00',
                'end' => '14:45:00',
            ),
            6 => 
            array (
                'id' => 7,
                'start' => '15:00:00',
                'end' => '15:45:00',
            ),
            7 => 
            array (
                'id' => 8,
                'start' => '16:00:00',
                'end' => '16:45:00',
            ),
            8 => 
            array (
                'id' => 9,
                'start' => '17:00:00',
                'end' => '17:45:00',
            ),
            9 => 
            array (
                'id' => 10,
                'start' => '21:00:00',
                'end' => '21:45:00',
            ),
        ));
        
        
    }
}