<?php

namespace Database\Seeds\Staging;

use Illuminate\Database\Seeder;

class LevelTeacherTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('level_teacher')->delete();
        
        \DB::table('level_teacher')->insert(array (
            0 => 
            array (
                'id' => 1,
                'teacher_id' => 1,
                'level_id' => 4,
            ),
            1 => 
            array (
                'id' => 2,
                'teacher_id' => 1,
                'level_id' => 5,
            ),
            2 => 
            array (
                'id' => 3,
                'teacher_id' => 2,
                'level_id' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'teacher_id' => 2,
                'level_id' => 3,
            ),
            4 => 
            array (
                'id' => 5,
                'teacher_id' => 3,
                'level_id' => 5,
            ),
            5 => 
            array (
                'id' => 6,
                'teacher_id' => 3,
                'level_id' => 4,
            ),
            6 => 
            array (
                'id' => 7,
                'teacher_id' => 4,
                'level_id' => 5,
            ),
            7 => 
            array (
                'id' => 8,
                'teacher_id' => 4,
                'level_id' => 8,
            ),
            8 => 
            array (
                'id' => 9,
                'teacher_id' => 5,
                'level_id' => 9,
            ),
            9 => 
            array (
                'id' => 10,
                'teacher_id' => 5,
                'level_id' => 9,
            ),
            10 => 
            array (
                'id' => 11,
                'teacher_id' => 6,
                'level_id' => 4,
            ),
            11 => 
            array (
                'id' => 12,
                'teacher_id' => 6,
                'level_id' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'teacher_id' => 7,
                'level_id' => 2,
            ),
            13 => 
            array (
                'id' => 14,
                'teacher_id' => 7,
                'level_id' => 6,
            ),
            14 => 
            array (
                'id' => 15,
                'teacher_id' => 8,
                'level_id' => 4,
            ),
            15 => 
            array (
                'id' => 16,
                'teacher_id' => 8,
                'level_id' => 3,
            ),
            16 => 
            array (
                'id' => 17,
                'teacher_id' => 9,
                'level_id' => 4,
            ),
            17 => 
            array (
                'id' => 18,
                'teacher_id' => 9,
                'level_id' => 6,
            ),
            18 => 
            array (
                'id' => 19,
                'teacher_id' => 10,
                'level_id' => 5,
            ),
            19 => 
            array (
                'id' => 20,
                'teacher_id' => 10,
                'level_id' => 3,
            ),
            20 => 
            array (
                'id' => 21,
                'teacher_id' => 11,
                'level_id' => 3,
            ),
            21 => 
            array (
                'id' => 22,
                'teacher_id' => 11,
                'level_id' => 3,
            ),
            22 => 
            array (
                'id' => 23,
                'teacher_id' => 12,
                'level_id' => 9,
            ),
            23 => 
            array (
                'id' => 24,
                'teacher_id' => 12,
                'level_id' => 3,
            ),
            24 => 
            array (
                'id' => 25,
                'teacher_id' => 13,
                'level_id' => 6,
            ),
            25 => 
            array (
                'id' => 26,
                'teacher_id' => 13,
                'level_id' => 5,
            ),
            26 => 
            array (
                'id' => 27,
                'teacher_id' => 14,
                'level_id' => 5,
            ),
            27 => 
            array (
                'id' => 28,
                'teacher_id' => 14,
                'level_id' => 1,
            ),
            28 => 
            array (
                'id' => 29,
                'teacher_id' => 15,
                'level_id' => 7,
            ),
            29 => 
            array (
                'id' => 30,
                'teacher_id' => 15,
                'level_id' => 7,
            ),
            30 => 
            array (
                'id' => 31,
                'teacher_id' => 16,
                'level_id' => 1,
            ),
            31 => 
            array (
                'id' => 32,
                'teacher_id' => 16,
                'level_id' => 5,
            ),
            32 => 
            array (
                'id' => 33,
                'teacher_id' => 17,
                'level_id' => 8,
            ),
            33 => 
            array (
                'id' => 34,
                'teacher_id' => 17,
                'level_id' => 6,
            ),
            34 => 
            array (
                'id' => 35,
                'teacher_id' => 18,
                'level_id' => 6,
            ),
            35 => 
            array (
                'id' => 36,
                'teacher_id' => 18,
                'level_id' => 9,
            ),
            36 => 
            array (
                'id' => 37,
                'teacher_id' => 19,
                'level_id' => 3,
            ),
            37 => 
            array (
                'id' => 38,
                'teacher_id' => 19,
                'level_id' => 7,
            ),
            38 => 
            array (
                'id' => 39,
                'teacher_id' => 20,
                'level_id' => 5,
            ),
            39 => 
            array (
                'id' => 40,
                'teacher_id' => 20,
                'level_id' => 6,
            ),
            40 => 
            array (
                'id' => 41,
                'teacher_id' => 21,
                'level_id' => 8,
            ),
            41 => 
            array (
                'id' => 42,
                'teacher_id' => 21,
                'level_id' => 1,
            ),
            42 => 
            array (
                'id' => 43,
                'teacher_id' => 22,
                'level_id' => 1,
            ),
            43 => 
            array (
                'id' => 44,
                'teacher_id' => 22,
                'level_id' => 2,
            ),
            44 => 
            array (
                'id' => 47,
                'teacher_id' => 22,
                'level_id' => 5,
            ),
            45 => 
            array (
                'id' => 48,
                'teacher_id' => 22,
                'level_id' => 6,
            ),
            46 => 
            array (
                'id' => 49,
                'teacher_id' => 23,
                'level_id' => 1,
            ),
            47 => 
            array (
                'id' => 50,
                'teacher_id' => 23,
                'level_id' => 9,
            ),
            48 => 
            array (
                'id' => 51,
                'teacher_id' => 24,
                'level_id' => 1,
            ),
            49 => 
            array (
                'id' => 52,
                'teacher_id' => 24,
                'level_id' => 2,
            ),
            50 => 
            array (
                'id' => 53,
                'teacher_id' => 24,
                'level_id' => 9,
            ),
            51 => 
            array (
                'id' => 54,
                'teacher_id' => 25,
                'level_id' => 1,
            ),
            52 => 
            array (
                'id' => 55,
                'teacher_id' => 25,
                'level_id' => 2,
            ),
            53 => 
            array (
                'id' => 56,
                'teacher_id' => 25,
                'level_id' => 8,
            ),
            54 => 
            array (
                'id' => 57,
                'teacher_id' => 26,
                'level_id' => 2,
            ),
            55 => 
            array (
                'id' => 58,
                'teacher_id' => 26,
                'level_id' => 3,
            ),
            56 => 
            array (
                'id' => 59,
                'teacher_id' => 26,
                'level_id' => 7,
            ),
            57 => 
            array (
                'id' => 60,
                'teacher_id' => 27,
                'level_id' => 1,
            ),
            58 => 
            array (
                'id' => 61,
                'teacher_id' => 27,
                'level_id' => 2,
            ),
            59 => 
            array (
                'id' => 62,
                'teacher_id' => 22,
                'level_id' => 3,
            ),
            60 => 
            array (
                'id' => 63,
                'teacher_id' => 22,
                'level_id' => 4,
            ),
            61 => 
            array (
                'id' => 64,
                'teacher_id' => 22,
                'level_id' => 7,
            ),
            62 => 
            array (
                'id' => 65,
                'teacher_id' => 22,
                'level_id' => 8,
            ),
            63 => 
            array (
                'id' => 66,
                'teacher_id' => 22,
                'level_id' => 9,
            ),
            64 => 
            array (
                'id' => 67,
                'teacher_id' => 28,
                'level_id' => 6,
            ),
            65 => 
            array (
                'id' => 68,
                'teacher_id' => 28,
                'level_id' => 8,
            ),
        ));
        
        
    }
}