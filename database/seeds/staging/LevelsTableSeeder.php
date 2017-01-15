<?php

namespace Database\Seeds\Staging;

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('levels')->delete();
        
        \DB::table('levels')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '一年级',
                'order' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '二年级',
                'order' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '三年级',
                'order' => 2,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '四年级',
                'order' => 3,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '五年级',
                'order' => 4,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '六年级',
                'order' => 5,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => '七年级',
                'order' => 6,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => '八年级',
                'order' => 7,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => '九年级',
                'order' => 8,
            ),
        ));
        
        
    }
}