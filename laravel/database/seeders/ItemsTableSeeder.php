<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['title' => 'PHP book',
             'description' => 'PHPについて学べます',
             'category_id' => 5,
             'period_id' => 4
            ],
            ['title' => '料理本',
            'description' => '簡単料理紹介します',
            'category_id' => 4,
            'period_id' => 4
            ]
        ];

        foreach($items as $item) {
            \App\Models\Item::create($item);
            }
    }
}
