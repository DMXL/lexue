<?php

namespace Seeds\Staging;

use Illuminate\Database\Seeder;

class LabelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('labels')->delete();
        
        \DB::table('labels')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'CET4',
                'order' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'CET6',
                'order' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'IELTS7',
                'order' => 2,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'IELTS8',
                'order' => 3,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'TOEFL100+',
                'order' => 4,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'TOEFL110+',
                'order' => 5,
            ),
        ));
        
        
    }
}