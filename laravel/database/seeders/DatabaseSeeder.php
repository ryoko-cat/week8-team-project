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
        // \App\Models\User::factory(10)->create();
        
        //MembersTableSeederを読み込むように指定
        $this->call(MembersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(PeriodsTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
    }
}
