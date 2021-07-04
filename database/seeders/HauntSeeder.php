<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class HauntSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('haunts')->delete();
        $json = File::get("database/data/Haunted_Places.json");
        $data = json_decode($json, TRUE);
        
        foreach ($data as $column) {
            DB::table('haunts')->insert(array(
                'country' => $column['country'],
                'state' => $column['state'],
                'city' => $column['city'],
                'location' => $column['location'],
                'description' => $column['description']
            ));
        }
    }
}
