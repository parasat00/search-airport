<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents('App/Library/airports.json');
        $data = json_decode($json, true);
//        dd($data['ADB']);

        foreach ($data as $code => $airport) {

            DB::table('airports')->insert([
                'code' => $code,
                'city_name' => json_encode($airport['cityName']),
                'airport_name' => isset($airport['airportName']) ? json_encode($airport['airportName']) : null,
                'area' => $airport['area'],
                'country' => $airport['country'],
                'lat' => $airport['lat'] ?? null,
                'lng' => $airport['lng'] ?? null,
                'timezone' => $airport['timezone']
            ]);
        }
    }
}
