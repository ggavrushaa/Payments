<?php

namespace App\Services\Bitcoin\Enums;

enum BitcoinTransactionCategoryEnum: string
{
    case receive = 'receive';
    case send = 'send';
}
