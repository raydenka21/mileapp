<?php

namespace App\Libraries;


class PaymentType
{
    const PAID = 'PAID';
    const UNPAID = 'UNPAID';
    public static $paymentType = [self::PAID, self::UNPAID];
}





