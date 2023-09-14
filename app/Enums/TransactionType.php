<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TransactionType extends Enum
{
    const CashinPIX = "cashinPIX";
    const CashoutPIX = "cashoutPIX";
    const CashinCC = "cashinCC";


}
