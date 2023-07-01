<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Organisation;
use App\Services\OrganisationStaffService;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $organisation = Organisation::where('user_id', Auth::id())->firstOrFail();

        $userData = $this->getUserData($row);

        $existingUser = User::where('email', $userData['email'])->first();

        if ($existingUser) {

            $existingUser->email = $userData['email'];
            $existingUser->full_name = $userData['full_name'];

            $existingUser->save();

            $existingUser->staff()->update([
                'job_title' => $row['job_title']
            ]);

            return $existingUser;
        }

        $staffData = [
            'organisation_id' => $organisation->id,
            'job_title' => $row['job_title']
        ];

        $user = (new OrganisationStaffService())->createStaffMember($userData, $staffData);

        return $user;
    }

    private function getUserData($request)
    {
        return [
            'full_name' => $request['full_name'],
            'email' => $request['email'],
        ];
    }
}
