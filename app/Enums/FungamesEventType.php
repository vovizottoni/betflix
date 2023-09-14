<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class FungamesEventType extends Enum
{
    const BetPlacing = "BetPlacing";
    const Lose = "Lose";
    const Win = "Win";
}
