<?php

namespace App\Enums;

enum PricingRule: string
{
    case BUY_ONE_GET_ONE_FREE = 'buy-one-get-one-free';
    case BULK_PURCHASE = 'bulk';
}
