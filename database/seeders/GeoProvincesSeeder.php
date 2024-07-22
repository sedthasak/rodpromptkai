<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class GeoProvincesSeeder extends Seeder
{
    public function run()
    {
        $csvFile = storage_path('app/public/provinces.csv');
        $csv = Reader::createFromPath($csvFile, 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            DB::table('geo_provinces')->updateOrInsert(
                ['id' => $record['id']],
                [
                    'name_th' => $record['name_th'],
                    'name_en' => $record['name_en'],
                    'geography_id' => $record['geography_id'],
                    'created_at' => $record['created_at'],
                    'updated_at' => $record['updated_at'],
                ]
            );
        }
    }
}
