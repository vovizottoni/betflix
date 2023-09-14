<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PaymentGatewaysEnum extends Enum
{
    const PagStar = 'PagStar';
    const FastPayments = 'FastPayments';
    const IstPay = 'IstPay';
}
