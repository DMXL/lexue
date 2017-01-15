<?php

use Illuminate\Database\Seeder;

class TeacherTimeSlotTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('teacher_time_slot')->delete();
        
        \DB::table('teacher_time_slot')->insert(array (
            0 => 
            array (
                'id' => 8,
                'time_slot_id' => 1,
                'teacher_id' => 2,
            ),
            1 => 
            array (
                'id' => 16,
                'time_slot_id' => 1,
                'teacher_id' => 3,
            ),
            2 => 
            array (
                'id' => 32,
                'time_slot_id' => 1,
                'teacher_id' => 5,
            ),
            3 => 
            array (
                'id' => 39,
                'time_slot_id' => 1,
                'teacher_id' => 6,
            ),
            4 => 
            array (
                'id' => 46,
                'time_slot_id' => 1,
                'teacher_id' => 7,
            ),
            5 => 
            array (
                'id' => 53,
                'time_slot_id' => 1,
                'teacher_id' => 8,
            ),
            6 => 
            array (
                'id' => 68,
                'time_slot_id' => 1,
                'teacher_id' => 10,
            ),
            7 => 
            array (
                'id' => 78,
                'time_slot_id' => 1,
                'teacher_id' => 11,
            ),
            8 => 
            array (
                'id' => 88,
                'time_slot_id' => 1,
                'teacher_id' => 12,
            ),
            9 => 
            array (
                'id' => 95,
                'time_slot_id' => 1,
                'teacher_id' => 13,
            ),
            10 => 
            array (
                'id' => 108,
                'time_slot_id' => 1,
                'teacher_id' => 15,
            ),
            11 => 
            array (
                'id' => 124,
                'time_slot_id' => 1,
                'teacher_id' => 17,
            ),
            12 => 
            array (
                'id' => 131,
                'time_slot_id' => 1,
                'teacher_id' => 18,
            ),
            13 => 
            array (
                'id' => 149,
                'time_slot_id' => 1,
                'teacher_id' => 20,
            ),
            14 => 
            array (
                'id' => 159,
                'time_slot_id' => 1,
                'teacher_id' => 21,
            ),
            15 => 
            array (
                'id' => 166,
                'time_slot_id' => 1,
                'teacher_id' => 22,
            ),
            16 => 
            array (
                'id' => 171,
                'time_slot_id' => 1,
                'teacher_id' => 23,
            ),
            17 => 
            array (
                'id' => 1,
                'time_slot_id' => 2,
                'teacher_id' => 1,
            ),
            18 => 
            array (
                'id' => 9,
                'time_slot_id' => 2,
                'teacher_id' => 2,
            ),
            19 => 
            array (
                'id' => 17,
                'time_slot_id' => 2,
                'teacher_id' => 3,
            ),
            20 => 
            array (
                'id' => 24,
                'time_slot_id' => 2,
                'teacher_id' => 4,
            ),
            21 => 
            array (
                'id' => 33,
                'time_slot_id' => 2,
                'teacher_id' => 5,
            ),
            22 => 
            array (
                'id' => 54,
                'time_slot_id' => 2,
                'teacher_id' => 8,
            ),
            23 => 
            array (
                'id' => 61,
                'time_slot_id' => 2,
                'teacher_id' => 9,
            ),
            24 => 
            array (
                'id' => 69,
                'time_slot_id' => 2,
                'teacher_id' => 10,
            ),
            25 => 
            array (
                'id' => 79,
                'time_slot_id' => 2,
                'teacher_id' => 11,
            ),
            26 => 
            array (
                'id' => 101,
                'time_slot_id' => 2,
                'teacher_id' => 14,
            ),
            27 => 
            array (
                'id' => 109,
                'time_slot_id' => 2,
                'teacher_id' => 15,
            ),
            28 => 
            array (
                'id' => 117,
                'time_slot_id' => 2,
                'teacher_id' => 16,
            ),
            29 => 
            array (
                'id' => 125,
                'time_slot_id' => 2,
                'teacher_id' => 17,
            ),
            30 => 
            array (
                'id' => 132,
                'time_slot_id' => 2,
                'teacher_id' => 18,
            ),
            31 => 
            array (
                'id' => 140,
                'time_slot_id' => 2,
                'teacher_id' => 19,
            ),
            32 => 
            array (
                'id' => 150,
                'time_slot_id' => 2,
                'teacher_id' => 20,
            ),
            33 => 
            array (
                'id' => 160,
                'time_slot_id' => 2,
                'teacher_id' => 21,
            ),
            34 => 
            array (
                'id' => 169,
                'time_slot_id' => 2,
                'teacher_id' => 22,
            ),
            35 => 
            array (
                'id' => 172,
                'time_slot_id' => 2,
                'teacher_id' => 23,
            ),
            36 => 
            array (
                'id' => 176,
                'time_slot_id' => 2,
                'teacher_id' => 24,
            ),
            37 => 
            array (
                'id' => 2,
                'time_slot_id' => 3,
                'teacher_id' => 1,
            ),
            38 => 
            array (
                'id' => 10,
                'time_slot_id' => 3,
                'teacher_id' => 2,
            ),
            39 => 
            array (
                'id' => 25,
                'time_slot_id' => 3,
                'teacher_id' => 4,
            ),
            40 => 
            array (
                'id' => 34,
                'time_slot_id' => 3,
                'teacher_id' => 5,
            ),
            41 => 
            array (
                'id' => 40,
                'time_slot_id' => 3,
                'teacher_id' => 6,
            ),
            42 => 
            array (
                'id' => 47,
                'time_slot_id' => 3,
                'teacher_id' => 7,
            ),
            43 => 
            array (
                'id' => 55,
                'time_slot_id' => 3,
                'teacher_id' => 8,
            ),
            44 => 
            array (
                'id' => 70,
                'time_slot_id' => 3,
                'teacher_id' => 10,
            ),
            45 => 
            array (
                'id' => 80,
                'time_slot_id' => 3,
                'teacher_id' => 11,
            ),
            46 => 
            array (
                'id' => 89,
                'time_slot_id' => 3,
                'teacher_id' => 12,
            ),
            47 => 
            array (
                'id' => 96,
                'time_slot_id' => 3,
                'teacher_id' => 13,
            ),
            48 => 
            array (
                'id' => 102,
                'time_slot_id' => 3,
                'teacher_id' => 14,
            ),
            49 => 
            array (
                'id' => 110,
                'time_slot_id' => 3,
                'teacher_id' => 15,
            ),
            50 => 
            array (
                'id' => 118,
                'time_slot_id' => 3,
                'teacher_id' => 16,
            ),
            51 => 
            array (
                'id' => 126,
                'time_slot_id' => 3,
                'teacher_id' => 17,
            ),
            52 => 
            array (
                'id' => 133,
                'time_slot_id' => 3,
                'teacher_id' => 18,
            ),
            53 => 
            array (
                'id' => 141,
                'time_slot_id' => 3,
                'teacher_id' => 19,
            ),
            54 => 
            array (
                'id' => 151,
                'time_slot_id' => 3,
                'teacher_id' => 20,
            ),
            55 => 
            array (
                'id' => 181,
                'time_slot_id' => 3,
                'teacher_id' => 22,
            ),
            56 => 
            array (
                'id' => 177,
                'time_slot_id' => 3,
                'teacher_id' => 24,
            ),
            57 => 
            array (
                'id' => 11,
                'time_slot_id' => 4,
                'teacher_id' => 2,
            ),
            58 => 
            array (
                'id' => 18,
                'time_slot_id' => 4,
                'teacher_id' => 3,
            ),
            59 => 
            array (
                'id' => 26,
                'time_slot_id' => 4,
                'teacher_id' => 4,
            ),
            60 => 
            array (
                'id' => 35,
                'time_slot_id' => 4,
                'teacher_id' => 5,
            ),
            61 => 
            array (
                'id' => 41,
                'time_slot_id' => 4,
                'teacher_id' => 6,
            ),
            62 => 
            array (
                'id' => 62,
                'time_slot_id' => 4,
                'teacher_id' => 9,
            ),
            63 => 
            array (
                'id' => 71,
                'time_slot_id' => 4,
                'teacher_id' => 10,
            ),
            64 => 
            array (
                'id' => 81,
                'time_slot_id' => 4,
                'teacher_id' => 11,
            ),
            65 => 
            array (
                'id' => 90,
                'time_slot_id' => 4,
                'teacher_id' => 12,
            ),
            66 => 
            array (
                'id' => 103,
                'time_slot_id' => 4,
                'teacher_id' => 14,
            ),
            67 => 
            array (
                'id' => 111,
                'time_slot_id' => 4,
                'teacher_id' => 15,
            ),
            68 => 
            array (
                'id' => 127,
                'time_slot_id' => 4,
                'teacher_id' => 17,
            ),
            69 => 
            array (
                'id' => 142,
                'time_slot_id' => 4,
                'teacher_id' => 19,
            ),
            70 => 
            array (
                'id' => 152,
                'time_slot_id' => 4,
                'teacher_id' => 20,
            ),
            71 => 
            array (
                'id' => 161,
                'time_slot_id' => 4,
                'teacher_id' => 21,
            ),
            72 => 
            array (
                'id' => 3,
                'time_slot_id' => 5,
                'teacher_id' => 1,
            ),
            73 => 
            array (
                'id' => 19,
                'time_slot_id' => 5,
                'teacher_id' => 3,
            ),
            74 => 
            array (
                'id' => 27,
                'time_slot_id' => 5,
                'teacher_id' => 4,
            ),
            75 => 
            array (
                'id' => 42,
                'time_slot_id' => 5,
                'teacher_id' => 6,
            ),
            76 => 
            array (
                'id' => 48,
                'time_slot_id' => 5,
                'teacher_id' => 7,
            ),
            77 => 
            array (
                'id' => 56,
                'time_slot_id' => 5,
                'teacher_id' => 8,
            ),
            78 => 
            array (
                'id' => 63,
                'time_slot_id' => 5,
                'teacher_id' => 9,
            ),
            79 => 
            array (
                'id' => 72,
                'time_slot_id' => 5,
                'teacher_id' => 10,
            ),
            80 => 
            array (
                'id' => 82,
                'time_slot_id' => 5,
                'teacher_id' => 11,
            ),
            81 => 
            array (
                'id' => 91,
                'time_slot_id' => 5,
                'teacher_id' => 12,
            ),
            82 => 
            array (
                'id' => 112,
                'time_slot_id' => 5,
                'teacher_id' => 15,
            ),
            83 => 
            array (
                'id' => 119,
                'time_slot_id' => 5,
                'teacher_id' => 16,
            ),
            84 => 
            array (
                'id' => 134,
                'time_slot_id' => 5,
                'teacher_id' => 18,
            ),
            85 => 
            array (
                'id' => 143,
                'time_slot_id' => 5,
                'teacher_id' => 19,
            ),
            86 => 
            array (
                'id' => 153,
                'time_slot_id' => 5,
                'teacher_id' => 20,
            ),
            87 => 
            array (
                'id' => 162,
                'time_slot_id' => 5,
                'teacher_id' => 21,
            ),
            88 => 
            array (
                'id' => 167,
                'time_slot_id' => 5,
                'teacher_id' => 22,
            ),
            89 => 
            array (
                'id' => 4,
                'time_slot_id' => 6,
                'teacher_id' => 1,
            ),
            90 => 
            array (
                'id' => 12,
                'time_slot_id' => 6,
                'teacher_id' => 2,
            ),
            91 => 
            array (
                'id' => 20,
                'time_slot_id' => 6,
                'teacher_id' => 3,
            ),
            92 => 
            array (
                'id' => 28,
                'time_slot_id' => 6,
                'teacher_id' => 4,
            ),
            93 => 
            array (
                'id' => 36,
                'time_slot_id' => 6,
                'teacher_id' => 5,
            ),
            94 => 
            array (
                'id' => 49,
                'time_slot_id' => 6,
                'teacher_id' => 7,
            ),
            95 => 
            array (
                'id' => 64,
                'time_slot_id' => 6,
                'teacher_id' => 9,
            ),
            96 => 
            array (
                'id' => 73,
                'time_slot_id' => 6,
                'teacher_id' => 10,
            ),
            97 => 
            array (
                'id' => 83,
                'time_slot_id' => 6,
                'teacher_id' => 11,
            ),
            98 => 
            array (
                'id' => 92,
                'time_slot_id' => 6,
                'teacher_id' => 12,
            ),
            99 => 
            array (
                'id' => 104,
                'time_slot_id' => 6,
                'teacher_id' => 14,
            ),
            100 => 
            array (
                'id' => 120,
                'time_slot_id' => 6,
                'teacher_id' => 16,
            ),
            101 => 
            array (
                'id' => 135,
                'time_slot_id' => 6,
                'teacher_id' => 18,
            ),
            102 => 
            array (
                'id' => 144,
                'time_slot_id' => 6,
                'teacher_id' => 19,
            ),
            103 => 
            array (
                'id' => 154,
                'time_slot_id' => 6,
                'teacher_id' => 20,
            ),
            104 => 
            array (
                'id' => 170,
                'time_slot_id' => 6,
                'teacher_id' => 22,
            ),
            105 => 
            array (
                'id' => 173,
                'time_slot_id' => 6,
                'teacher_id' => 23,
            ),
            106 => 
            array (
                'id' => 5,
                'time_slot_id' => 7,
                'teacher_id' => 1,
            ),
            107 => 
            array (
                'id' => 13,
                'time_slot_id' => 7,
                'teacher_id' => 2,
            ),
            108 => 
            array (
                'id' => 29,
                'time_slot_id' => 7,
                'teacher_id' => 4,
            ),
            109 => 
            array (
                'id' => 37,
                'time_slot_id' => 7,
                'teacher_id' => 5,
            ),
            110 => 
            array (
                'id' => 43,
                'time_slot_id' => 7,
                'teacher_id' => 6,
            ),
            111 => 
            array (
                'id' => 50,
                'time_slot_id' => 7,
                'teacher_id' => 7,
            ),
            112 => 
            array (
                'id' => 57,
                'time_slot_id' => 7,
                'teacher_id' => 8,
            ),
            113 => 
            array (
                'id' => 65,
                'time_slot_id' => 7,
                'teacher_id' => 9,
            ),
            114 => 
            array (
                'id' => 74,
                'time_slot_id' => 7,
                'teacher_id' => 10,
            ),
            115 => 
            array (
                'id' => 84,
                'time_slot_id' => 7,
                'teacher_id' => 11,
            ),
            116 => 
            array (
                'id' => 93,
                'time_slot_id' => 7,
                'teacher_id' => 12,
            ),
            117 => 
            array (
                'id' => 97,
                'time_slot_id' => 7,
                'teacher_id' => 13,
            ),
            118 => 
            array (
                'id' => 105,
                'time_slot_id' => 7,
                'teacher_id' => 14,
            ),
            119 => 
            array (
                'id' => 113,
                'time_slot_id' => 7,
                'teacher_id' => 15,
            ),
            120 => 
            array (
                'id' => 121,
                'time_slot_id' => 7,
                'teacher_id' => 16,
            ),
            121 => 
            array (
                'id' => 128,
                'time_slot_id' => 7,
                'teacher_id' => 17,
            ),
            122 => 
            array (
                'id' => 136,
                'time_slot_id' => 7,
                'teacher_id' => 18,
            ),
            123 => 
            array (
                'id' => 145,
                'time_slot_id' => 7,
                'teacher_id' => 19,
            ),
            124 => 
            array (
                'id' => 155,
                'time_slot_id' => 7,
                'teacher_id' => 20,
            ),
            125 => 
            array (
                'id' => 163,
                'time_slot_id' => 7,
                'teacher_id' => 21,
            ),
            126 => 
            array (
                'id' => 182,
                'time_slot_id' => 7,
                'teacher_id' => 22,
            ),
            127 => 
            array (
                'id' => 174,
                'time_slot_id' => 7,
                'teacher_id' => 23,
            ),
            128 => 
            array (
                'id' => 178,
                'time_slot_id' => 7,
                'teacher_id' => 24,
            ),
            129 => 
            array (
                'id' => 14,
                'time_slot_id' => 8,
                'teacher_id' => 2,
            ),
            130 => 
            array (
                'id' => 21,
                'time_slot_id' => 8,
                'teacher_id' => 3,
            ),
            131 => 
            array (
                'id' => 30,
                'time_slot_id' => 8,
                'teacher_id' => 4,
            ),
            132 => 
            array (
                'id' => 38,
                'time_slot_id' => 8,
                'teacher_id' => 5,
            ),
            133 => 
            array (
                'id' => 44,
                'time_slot_id' => 8,
                'teacher_id' => 6,
            ),
            134 => 
            array (
                'id' => 51,
                'time_slot_id' => 8,
                'teacher_id' => 7,
            ),
            135 => 
            array (
                'id' => 58,
                'time_slot_id' => 8,
                'teacher_id' => 8,
            ),
            136 => 
            array (
                'id' => 66,
                'time_slot_id' => 8,
                'teacher_id' => 9,
            ),
            137 => 
            array (
                'id' => 75,
                'time_slot_id' => 8,
                'teacher_id' => 10,
            ),
            138 => 
            array (
                'id' => 85,
                'time_slot_id' => 8,
                'teacher_id' => 11,
            ),
            139 => 
            array (
                'id' => 98,
                'time_slot_id' => 8,
                'teacher_id' => 13,
            ),
            140 => 
            array (
                'id' => 106,
                'time_slot_id' => 8,
                'teacher_id' => 14,
            ),
            141 => 
            array (
                'id' => 114,
                'time_slot_id' => 8,
                'teacher_id' => 15,
            ),
            142 => 
            array (
                'id' => 122,
                'time_slot_id' => 8,
                'teacher_id' => 16,
            ),
            143 => 
            array (
                'id' => 129,
                'time_slot_id' => 8,
                'teacher_id' => 17,
            ),
            144 => 
            array (
                'id' => 137,
                'time_slot_id' => 8,
                'teacher_id' => 18,
            ),
            145 => 
            array (
                'id' => 146,
                'time_slot_id' => 8,
                'teacher_id' => 19,
            ),
            146 => 
            array (
                'id' => 156,
                'time_slot_id' => 8,
                'teacher_id' => 20,
            ),
            147 => 
            array (
                'id' => 164,
                'time_slot_id' => 8,
                'teacher_id' => 21,
            ),
            148 => 
            array (
                'id' => 179,
                'time_slot_id' => 8,
                'teacher_id' => 24,
            ),
            149 => 
            array (
                'id' => 6,
                'time_slot_id' => 9,
                'teacher_id' => 1,
            ),
            150 => 
            array (
                'id' => 22,
                'time_slot_id' => 9,
                'teacher_id' => 3,
            ),
            151 => 
            array (
                'id' => 45,
                'time_slot_id' => 9,
                'teacher_id' => 6,
            ),
            152 => 
            array (
                'id' => 59,
                'time_slot_id' => 9,
                'teacher_id' => 8,
            ),
            153 => 
            array (
                'id' => 76,
                'time_slot_id' => 9,
                'teacher_id' => 10,
            ),
            154 => 
            array (
                'id' => 86,
                'time_slot_id' => 9,
                'teacher_id' => 11,
            ),
            155 => 
            array (
                'id' => 99,
                'time_slot_id' => 9,
                'teacher_id' => 13,
            ),
            156 => 
            array (
                'id' => 107,
                'time_slot_id' => 9,
                'teacher_id' => 14,
            ),
            157 => 
            array (
                'id' => 115,
                'time_slot_id' => 9,
                'teacher_id' => 15,
            ),
            158 => 
            array (
                'id' => 138,
                'time_slot_id' => 9,
                'teacher_id' => 18,
            ),
            159 => 
            array (
                'id' => 147,
                'time_slot_id' => 9,
                'teacher_id' => 19,
            ),
            160 => 
            array (
                'id' => 157,
                'time_slot_id' => 9,
                'teacher_id' => 20,
            ),
            161 => 
            array (
                'id' => 175,
                'time_slot_id' => 9,
                'teacher_id' => 23,
            ),
            162 => 
            array (
                'id' => 180,
                'time_slot_id' => 9,
                'teacher_id' => 24,
            ),
            163 => 
            array (
                'id' => 7,
                'time_slot_id' => 10,
                'teacher_id' => 1,
            ),
            164 => 
            array (
                'id' => 15,
                'time_slot_id' => 10,
                'teacher_id' => 2,
            ),
            165 => 
            array (
                'id' => 23,
                'time_slot_id' => 10,
                'teacher_id' => 3,
            ),
            166 => 
            array (
                'id' => 31,
                'time_slot_id' => 10,
                'teacher_id' => 4,
            ),
            167 => 
            array (
                'id' => 52,
                'time_slot_id' => 10,
                'teacher_id' => 7,
            ),
            168 => 
            array (
                'id' => 60,
                'time_slot_id' => 10,
                'teacher_id' => 8,
            ),
            169 => 
            array (
                'id' => 67,
                'time_slot_id' => 10,
                'teacher_id' => 9,
            ),
            170 => 
            array (
                'id' => 77,
                'time_slot_id' => 10,
                'teacher_id' => 10,
            ),
            171 => 
            array (
                'id' => 87,
                'time_slot_id' => 10,
                'teacher_id' => 11,
            ),
            172 => 
            array (
                'id' => 94,
                'time_slot_id' => 10,
                'teacher_id' => 12,
            ),
            173 => 
            array (
                'id' => 100,
                'time_slot_id' => 10,
                'teacher_id' => 13,
            ),
            174 => 
            array (
                'id' => 116,
                'time_slot_id' => 10,
                'teacher_id' => 15,
            ),
            175 => 
            array (
                'id' => 123,
                'time_slot_id' => 10,
                'teacher_id' => 16,
            ),
            176 => 
            array (
                'id' => 130,
                'time_slot_id' => 10,
                'teacher_id' => 17,
            ),
            177 => 
            array (
                'id' => 139,
                'time_slot_id' => 10,
                'teacher_id' => 18,
            ),
            178 => 
            array (
                'id' => 148,
                'time_slot_id' => 10,
                'teacher_id' => 19,
            ),
            179 => 
            array (
                'id' => 158,
                'time_slot_id' => 10,
                'teacher_id' => 20,
            ),
            180 => 
            array (
                'id' => 165,
                'time_slot_id' => 10,
                'teacher_id' => 21,
            ),
            181 => 
            array (
                'id' => 168,
                'time_slot_id' => 10,
                'teacher_id' => 22,
            ),
        ));
        
        
    }
}