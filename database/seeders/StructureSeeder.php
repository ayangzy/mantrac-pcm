<?php

namespace Database\Seeders;

use App\Models\Structure;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $structures = [
            [
                'name' => 'Subsidiary'
            ],

            [
                'name' => 'Zonal Offices'
            ],

            [
                'name' => 'Branches'
            ],

            [
                'name' => 'Departments'
            ],

            [
                'name' => 'Units'
            ],
        ];

        foreach ($structures as $structure) {
            Structure::firstOrCreate($structure);
        }
    }
}
