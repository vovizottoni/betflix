<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BalanceUsedEnum extends Enum
{
    const Balance = "balance";
    const BalanceBonus = "balanceBonus";
    const BalanceUSDBonus = "balanceUSDBonus";
    const BalanceUSD = "balanceUSD";
}
