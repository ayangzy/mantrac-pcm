<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Staff;
use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StaffJobDescriptionImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $organisation = Organisation::where('user_id', Auth::id())->firstOrFail();

        $jobDescription = $row['job_description'];

        $user = User::where('email', $row['email'])->first();

        $existingStaffMembers = Staff::where('user_id', $user->id)
            ->where('organisation_id', $organisation->id)->get();

        foreach ($existingStaffMembers as $staffMember) {
            $staffMember->job_description = $jobDescription;

            $staffMember->save();
        }
    }
}
