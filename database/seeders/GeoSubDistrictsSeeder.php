<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class GeoSubDistrictsSeeder extends Seeder
{
    public function run()
    {
        $csvFile = storage_path('app/public/sub_districts.csv');
        $csv = Reader::createFromPath($csvFile, 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            DB::table('geo_sub_districts')->updateOrInsert(
                ['id' => $record['id']],
                [
                    'zip_code' => $record['zip_code'],
                    'name_th' => $record['name_th'],
                    'name_en' => $record['name_en'],
                    'district_id' => $record['district_id'],
                    'created_at' => $record['created_at'],
                    'updated_at' => $record['updated_at'],
                ]
            );
        }
    }
}
