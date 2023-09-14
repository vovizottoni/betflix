<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TransactionStatus extends Enum
{
    const Paid = "paid";
    const Canceled = "canceled";
    const WaitingForPayment = "waiting_for_payment";
    const Drawee = "drawee";
    const WaitingForWithdraw="waiting_for_withdraw";
}
