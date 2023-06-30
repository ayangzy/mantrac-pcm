<?php

namespace App\Http\Controllers\Admin;

use App\Models\Structure;
use App\Services\StructureService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveStructureRequest;


class StructureController extends Controller
{

    public function index()
    {
        $organisationStructures = Structure::query()->select('id', 'name')->get();

        return $this->successResponse('Structures retrieved successfully', $organisationStructures);
    }

    public function store(SaveStructureRequest $request, StructureService $structureService)
    {
        $selectedStructures = $request->input('structures', []);

        $savedOrganisation = $structureService->store($selectedStructures);

        return $this->createdResponse('Structures saved successfully', $savedOrganisation);
    }
}
