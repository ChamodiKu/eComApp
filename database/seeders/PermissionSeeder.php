<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET foreign_key_checks = 0");
        DB::table('permissions')->truncate(); 

        $csvFile = fopen(public_path("csvs/permissions.csv"), "r");

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            DB::table('permissions')->insert([
                "name" => $data['0'],
                "guard_name" => 'web',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
                
            ]);
        }

        fclose($csvFile);
        
        DB::statement("SET foreign_key_checks = 1");

    }
}
