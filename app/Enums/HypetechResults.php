<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class HypetechResults extends Enum
{
    const Green = 'green';
    const Red = "red";
    const Pending = "pending";
    const Canceled = "canceled";
}
