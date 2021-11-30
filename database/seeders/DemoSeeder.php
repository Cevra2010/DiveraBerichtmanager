<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    public function run()
    {
        \DB::table('personals')->insert([
            'firstname' => 'Demo',
            'lastname' => 'Benutzer 1',
            'gf' => '1',
        ]);

        \DB::table('personals')->insert([
            'firstname' => 'Demo',
            'lastname' => 'Benutzer 2',
            'gf' => '0',
        ]);

        \DB::table('personals')->insert([
            'firstname' => 'Demo',
            'lastname' => 'Benutzer 3',
            'gf' => '0',
        ]);
    }
}
