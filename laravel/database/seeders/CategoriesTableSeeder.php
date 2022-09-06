<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('categories')->truncate();

        $categories = [
            ['type' => '雑誌'],
            ['type' => 'コミック'],
            ['type' => '文庫'],
            ['type' => '実用書'],
            ['type' => '児童書・学習参考書'],
            ['type' => '専門書'],
            ['type' => 'その他']
        ];

        foreach($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
