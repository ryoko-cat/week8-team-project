<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('periods')->truncate();

        $periods = [
            ['days' => 7],
            ['days' => 14],
            ['days' => 21],
            ['days' => 28]
        ];

        foreach($periods as $period) {
            \App\Models\Period::create($period);
        }
    }
}
