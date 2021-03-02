<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class InteractionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('interactions')->insert([
        	'name'=>'like',
        	'icon'=>'like.svg',
        ]);

        DB::table('interactions')->insert([
        	'name'=>'love',
        	'icon'=>'love.svg',
        ]);

        DB::table('interactions')->insert([
        	'name'=>'haha',
        	'icon'=>'haha.svg',
        ]);

        DB::table('interactions')->insert([
        	'name'=>'sad',
        	'icon'=>'sad.svg',
        ]);

        DB::table('interactions')->insert([
        	'name'=>'angry',
        	'icon'=>'angry.svg',
        ]);
    }
}
