<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TransactionDepositBonusStatus extends Enum
{
    const Pending = "Pending";
    const Paid = "Paid";
}
