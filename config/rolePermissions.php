<?php

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Spatie\Permission\Contracts\Permission;

return [
    RoleEnum::SUPER_ADMIN => [
        PermissionEnum::ADD_ORG_INFO,
        PermissionEnum::ADD_ORG_STRUCTURE,
        PermissionEnum::UPLOAD_ORG_STAFF,
        PermissionEnum::START_NEW_FINANCIAL_YEAR,
        PermissionEnum::UPLOAD_STRATEGIC_PILLARS,
        PermissionEnum::SET_MISSION_STATEMENT,
        PermissionEnum::CREATE_STATEGIC_INTENT,
        PermissionEnum::CREATE_SPECIFIED_TASK,
        PermissionEnum::CREATE_IMPLIED_TASK,
        PermissionEnum::SET_BOUNDARY,
        PermissionEnum::APPROVE_IMPLIED_TASK,
        PermissionEnum::UPLOAD_MISSION_PLAN,
        PermissionEnum::APPROVE_MISSION_PLAN,
        PermissionEnum::UPDATE_TASK_PROGRESS,
        PermissionEnum::UPDATE_SUCCESS_PROGRESS,
        PermissionEnum::ADD_STAFF_MISSION_PLAN
    ],

    RoleEnum::ADMIN_PC => [
        PermissionEnum::ADD_ORG_INFO,
        PermissionEnum::ADD_ORG_STRUCTURE,
        PermissionEnum::UPLOAD_ORG_STAFF
    ],

    RoleEnum::ADMIN_STRATEGY => [
        PermissionEnum::START_NEW_FINANCIAL_YEAR,
        PermissionEnum::UPLOAD_STRATEGIC_PILLARS,
        PermissionEnum::ADD_STAFF_MISSION_PLAN
    ],

    RoleEnum::LINE_MANAGER => [
        PermissionEnum::APPROVE_MISSION_PLAN
    ],

    RoleEnum::STAFF => [
        PermissionEnum::UPDATE_TASK_PROGRESS,
        PermissionEnum::UPDATE_SUCCESS_PROGRESS
    ]
];
