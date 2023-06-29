<?php

namespace Database\Seeders;

use App\Models\OrganisationStructure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganisationStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organisationStructures = [
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

        foreach ($organisationStructures as $organisationStructure) {
            OrganisationStructure::firstOrCreate($organisationStructure);
        }
    }
}
