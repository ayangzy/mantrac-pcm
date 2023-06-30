<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;

class StructureService
{
    public function store(array $selectedStructures): Organisation
    {
        $organisation = Organisation::where('user_id', Auth::id())->first();

        if (!$organisation) {
            throw new NotFoundException('Organisation not found');
        }

        $organisation->structures()->detach();
        $organisation->structures()->attach($selectedStructures);

        return Organisation::with('structures:id,name')->findOrFail($organisation->id);
    }
}
