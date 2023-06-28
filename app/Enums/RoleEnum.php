<?php


namespace App\Enums;

use App\Utils\BaseEnum;

class RoleEnum extends BaseEnum
{
    const SUPER_ADMIN = 'SUPER_ADMIN';
    const ADMIN_PC = 'ADMIN_PC';
    const ADMIN_STRATEGY = 'ADMIN_STRATEGY';
    const LINE_MANAGER = 'LINE_MANAGER';
    const STAFF = 'STAFF';
}
