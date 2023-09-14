<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PixCashoutStatusEnum extends Enum
{
    const Paid = 'Paid';
    const Cancelled = 'Cancelled';
}
