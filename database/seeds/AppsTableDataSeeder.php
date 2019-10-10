<?php

use Illuminate\Database\Seeder;

class AppsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App::create([
            'name'         => 'Example App',
            'description'  => 'Example app client',
            'version'      => '1.0.0',
            'access_token' => 'wBXMGfw1GSsgzpUdTSBaW55ttp7vVCZ9QVmWis6xXiVbYBEPkOILLS3zrPeU',
        ]);
    }
}
