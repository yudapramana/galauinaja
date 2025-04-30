<?php

namespace App\Enums;

enum RoleType: int
{
    case SUPERADMIN = 1;
    case ADMIN = 2;
    case USER = 3;
    case REVIEWER = 4;
}