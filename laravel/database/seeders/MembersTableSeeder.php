<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // // テーブルのクリア
        // DB::table('members')->truncate();

        $members = [
            ['name' => 'adimin',
             'email' => "msE@mse.com",
             'password' => Hash::make("password"),
             'role' => 1]
        ];
        
        //登録
        foreach($members as $member) {
            \App\Models\Member::create($member);
            }
    }
}
