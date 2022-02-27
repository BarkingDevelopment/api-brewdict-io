<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Member()
 * @method static static Admin()
 */
final class UserRole extends Enum
{
    const Member =   0;
    const Admin =   99;
}
