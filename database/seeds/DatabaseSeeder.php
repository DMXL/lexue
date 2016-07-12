<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $seeders;

    /**
     * DatabaseSeeder constructor.
     */
    public function __construct()
    {
        /*
         * Configure each environment separately because order matters
         */
        if (isLocal()) {
            $this->seeders = [
                StudentsTableSeeder::class,

                TeachersTableSeeder::class,
                LevelsTableSeeder::class,
                LevelTeacherPivotTableSeeder::class,

                LecturesTableSeeder::class,
                OffTimesTableSeeder::class,

                AdminsTableSeeder::class,
            ];
        } else {
            $this->seeders = [
                LevelsTableSeeder::class,
            ];
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->seeders as $seeder) {
            $this->call($seeder);
        }
    }
}
