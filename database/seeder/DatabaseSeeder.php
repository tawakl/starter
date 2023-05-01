<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(BasicSeeder::class);
        $this->call(GovernorateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(PolicySeeder::class);
        $this->call(CategoryTableDataSeeder::class);
        $this->call(YearsTableDataSeeder::class);
        $this->call(QuestionsTableDataSeeder::class);
    }
}
