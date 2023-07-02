<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\Staff;
use App\Models\Organisation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Exceptions\NotFoundException;
use App\Traits\GeneratePasswordResetToken;
use App\Mail\OrganisationStaffOnboardingMail;
use App\Mail\SendStaffProfileUpdatedNotificationMail;

class OrganisationStaffService
{
    use GeneratePasswordResetToken;

    public function getStaffMembers()
    {
        $organization = Organisation::where('user_id', Auth::id())->firstOrFail()->id;

        $staff = Staff::whereHas('organisation', function ($query) use ($organization) {
            $query->where('id', $organization);
        })->with('user:id,full_name,email')->paginate(10);

        return $staff;
    }


    public function createStaffMember(array $userData, array $staffData)
    {
        DB::beginTransaction();
        try {
            $user = User::create($userData);

            $staff = $user->staff()->create($staffData);

            $url = $this->generateToken($user->email);

            DB::commit();
            Mail::to($user->email)->send(new OrganisationStaffOnboardingMail($user, $url));
            return $staff;
        } catch (Exception $e) {
            DB::rollBack();
            logger($e);
            throw new Exception('An error occurred while processing your request');
        }
    }

    public function getStaffMember($id)
    {
        $staff = Staff::find($id);

        if (!$staff) {
            throw new NotFoundException('Staff not found');
        }

        return $staff;
    }

    public function updateStaffMember($id, array $userData, array $staffData)
    {
        $staff = Staff::find($id);

        if (!$staff) {
            throw new NotFoundException('Staff not found');
        }

        $user = User::where('id', $staff->user_id)->first();

        if (!$user) {
            throw new NotFoundException('User not found');
        }

        $user->update($userData);

        $staff->fill($staffData);
        $staff->save();

        Mail::to($user->email)->send(new SendStaffProfileUpdatedNotificationMail($user));

        return $staff;
    }

    public function deleteStaffMember($id): void
    {
        $staff = Staff::find($id);

        if (!$staff) {
            throw new NotFoundException('Staff not found');
        }

        DB::transaction(function () use ($staff) {
            $user = $staff->user;
            $staff->delete();
            $user->delete();
        });
    }
}
