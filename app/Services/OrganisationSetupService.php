<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Organisation;
use App\Models\OrganisationSetup;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Models\OrganisationStructure;
use Exception;

class OrganisationSetupService
{

    public function getAllOrganisationSetups()
    {
        $organisationId = Organisation::where('user_id', Auth::id())->value('id');

        return OrganisationSetup::with('structure:id,name', 'organisation:id,organisation_name')
            ->where('organisation_id', $organisationId)
            ->get();
    }

    public function saveOrganisationSetup(int $structureId, array $organisationSetups): Collection
    {

        $organisationId = Organisation::where('user_id', Auth::id())->firstOrFail()->id;

        $createdSetups = new Collection();

        foreach ($organisationSetups as $setup) {
            $organisationStructure = OrganisationStructure::where('organisation_id', $organisationId)
                ->where('structure_id', $structureId)
                ->first();

            if ($organisationStructure) {
                $lineManagerId = $setup['line_manager_id'] ?? null;
                $name = $setup['name'];

                $organisationSetup = OrganisationSetup::create([
                    'organisation_id' => $organisationId,
                    'structure_id' => $structureId,
                    'line_manager_id' => $lineManagerId,
                    'name' => $name,
                ]);

                $createdSetups->push($organisationSetup);
            }
        }

        return $createdSetups;
    }


    public function getOrganisationSetupById($id)
    {
        $organisationSetup = OrganisationSetup::find($id);

        if (!$organisationSetup) {
            throw new NotFoundException('Organisation set up not found');
        }

        return $organisationSetup;
    }

    public function updateOrganisationSetup($id, $lineManagerId, $name)
    {
        $organisationSetup = OrganisationSetup::find($id);

        if (!$organisationSetup) {
            throw new NotFoundException('Organisation set up not found');
        }

        $organisationSetup->line_manager_id = $lineManagerId;
        $organisationSetup->name = $name;

        $organisationSetup->save();

        return $organisationSetup;
    }

    public function deleteOrganisationSetup($id)
    {
        $organisationSetup = OrganisationSetup::find($id);

        if (!$organisationSetup) {
            throw new NotFoundException('Organisation set up not found');
        }

        $organisationSetup->delete();
    }
}
