<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Draft()
 * @method static static Published()
 * @method static static Private()
 */
final class RecipeState extends Enum
{
    const Draft =   0;
    const Published =   1;
    const Private = 2;
}
