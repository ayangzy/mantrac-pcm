<?php

namespace App\Services;

use App\Models\Organisation;
use App\Exceptions\NotFoundException;

class OrganisationService
{
    public function getAllOrganisations()
    {
        return Organisation::query()->get();
    }

    public function createOrganisation(array $data)
    {
        return Organisation::create($data);
    }

    public function getOrganisationById($id)
    {
        $organisation = Organisation::find($id);

        if (!$organisation) {
            throw new NotFoundException('Organisation not found');
        }

        return $organisation;
    }

    public function updateOrganisation($id, array $data)
    {
        $organisation = Organisation::find($id);

        if (!$organisation) {
            throw new NotFoundException('Organisation not found');
        }

        $organisation->update($data);

        return $organisation;
    }

    public function deleteOrganisation($id)
    {
        $organisation = Organisation::find($id);

        if (!$organisation) {
            throw new NotFoundException('Organisation not found');
        }

        $organisation->delete();
    }
}