<?php

use Illuminate\Database\Seeder;


class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'name' => 'launch_date',
            'value' => date('Y') . '-12-31',
        ]);

        DB::table('settings')->insert([
            'name' => 'fb_page',
            'value' => 'https://www.facebook.com',
        ]);

        DB::table('settings')->insert([
            'name' => 'gplus_page',
            'value' => 'https://www.google.com',
        ]);

        DB::table('settings')->insert([
            'name' => 'tw_page',
            'value' => 'https://www.twiter.com',
        ]);

        DB::table('settings')->insert([
            'name' => 'insta_page',
            'value' => 'https://www.instagram.com',
        ]);

        DB::table('settings')->insert([
            'name' => 'home_message',
            'value' => 'UNDER CONSTRUCTION',
        ]);

        DB::table('settings')->insert([
            'name' => 'brand_message',
            'value' => 'we are getting ready for a big launch!!!!',
        ]);

        DB::table('backgrounds')->insert([
            'image' => '1.jpg',
            'active' => 1,
        ]);

        DB::table('backgrounds')->insert([
            'image' => '2.jpg',
            'active' => 0,
        ]);

        DB::table('backgrounds')->insert([
            'image' => '3.jpg',
            'active' => 0,
        ]);

        DB::table('backgrounds')->insert([
            'image' => '4.jpg',
            'active' => 0,
        ]);
        DB::table('backgrounds')->insert([
            'image' => '5.jpg',
            'active' => 0,
        ]);
        DB::table('backgrounds')->insert([
            'image' => '6.jpg',
            'active' => 0,
        ]);
        DB::table('backgrounds')->insert([
            'image' => '7.jpg',
            'active' => 0,
        ]);
    }
}
