<?php

namespace App\Imports;

use App\Models\Organisation;
use App\Models\OrganisationSetup;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Models\OrganisationStructure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OrganisationStructureImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $organisationId = Organisation::where('user_id', Auth::id())->firstOrFail()->id;

        $structureId = request()->structure_id;

        $existingNames = OrganisationSetup::where('organisation_id', $organisationId)
            ->where('structure_id', $structureId)
            ->pluck('name')
            ->toArray();

        $recordUpdated = false;

        foreach ($existingNames as $name) {
            if ($name === $row['name']) {
                $recordUpdated = true;
                break;
            }
        }

        if (!$recordUpdated) {
            $organisationSetup = new OrganisationSetup([
                'organisation_id' => $organisationId,
                'structure_id' => $structureId,
                'name' => $row['name'],
            ]);
            $organisationSetup->save();
        }
    }
}
