<?php

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Spatie\Permission\Contracts\Permission;

return [
    RoleEnum::SUPER_ADMIN => [
        PermissionEnum::ADD_ORG_INFO,
        PermissionEnum::EDIT_ORG_INFO,
        PermissionEnum::VIEW_ORG_INFO,
        PermissionEnum::DELETE_ORG_INFO,
        PermissionEnum::ADD_ORG_STRUCTURE,
        PermissionEnum::VIEW_ORG_STRUCTURE,
        PermissionEnum::ASSIGN_PERMISSION,
        PermissionEnum::DETACH_PERMISSION,
        PermissionEnum::ASSIGN_ROLE,
        PermissionEnum::DETACH_ROLE,
        PermissionEnum::VIEW_PERMISSIONS,
        PermissionEnum::VIEW_ROLES,
        PermissionEnum::ADD_ORG_SETUP,
        PermissionEnum::EDIT_ORG_SETUP,
        PermissionEnum::VIEW_ORG_SETUP,
        PermissionEnum::DELETE_ORG_SETUP,
        PermissionEnum::ADD_ORG_STAFF,
        PermissionEnum::EDIT_ORG_STAFF,
        PermissionEnum::VIEW_ORG_STAFF,
        PermissionEnum::DELETE_ORG_STAFF,
        PermissionEnum::UPLOAD_ORG_STAFF,
        PermissionEnum::UPLOAD_ORG_SETUP,
        PermissionEnum::UPLOAD_ORG_JOB_DESC,
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
        PermissionEnum::EDIT_ORG_INFO,
        PermissionEnum::VIEW_ORG_INFO,
        PermissionEnum::DELETE_ORG_INFO,
        PermissionEnum::ADD_ORG_STRUCTURE,
        PermissionEnum::VIEW_ORG_STRUCTURE,
        PermissionEnum::ASSIGN_PERMISSION,
        PermissionEnum::DETACH_PERMISSION,
        PermissionEnum::ASSIGN_ROLE,
        PermissionEnum::DETACH_ROLE,
        PermissionEnum::VIEW_PERMISSIONS,
        PermissionEnum::VIEW_ROLES,
        PermissionEnum::ADD_ORG_SETUP,
        PermissionEnum::EDIT_ORG_SETUP,
        PermissionEnum::VIEW_ORG_SETUP,
        PermissionEnum::DELETE_ORG_SETUP,
        PermissionEnum::ADD_ORG_STAFF,
        PermissionEnum::EDIT_ORG_STAFF,
        PermissionEnum::VIEW_ORG_STAFF,
        PermissionEnum::DELETE_ORG_STAFF,
        PermissionEnum::UPLOAD_ORG_STAFF,
        PermissionEnum::UPLOAD_ORG_SETUP,
        PermissionEnum::UPLOAD_ORG_JOB_DESC,
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
