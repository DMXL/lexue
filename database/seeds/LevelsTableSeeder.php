<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    private $sample = ['一年级','二年级','三年级','四年级','五年级','六年级','七年级','八年级','九年级'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->sample as $index => $level) {
            DB::table('levels')->insert([
                'name' => $level,
                'order' => $index,
            ]);
        }
    }
}
