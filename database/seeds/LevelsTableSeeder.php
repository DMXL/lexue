<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    private $sample = ['早教','小学','初中','高中','大学','Chinglish'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->sample as $index => $level)
        DB::table('levels')->insert([
            'name' => $level,
            'order' => $index,
        ]);
    }
}
