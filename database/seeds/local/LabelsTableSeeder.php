<?php

namespace Database\Seeds\Local;

use Illuminate\Database\Seeder;

class LabelsTableSeeder extends Seeder
{
    private $sample = ['CET4', 'CET6', 'IELTS7', 'IELTS8', 'TOEFL100+', 'TOEFL110+'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->sample as $index => $label) {
            \DB::table('labels')->insert([
                'name' => $label,
                'order' => $index,
            ]);
        }
    }
}
