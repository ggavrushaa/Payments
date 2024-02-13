<?php

namespace App\Services\Bitcoin;

use App\Services\Bitcoin\BitcoinClient;
use App\Services\Bitcoin\BitcoinConfig;
use App\Services\Bitcoin\Entities\BitcoinTransactionEntity;
use App\Services\Bitcoin\Enums\BitcoinTransactionCategoryEnum;
use Illuminate\Support\Collection;

class BitcoinService
{
    public function __construct(
        private readonly BitcoinConfig $config
        ) {

    }
    public function getBlockchainInfo(): array
    {   
        return $this->send('getblockchaininfo');
    }
    public function getNewAddress(): string
    {   
        return $this->send('getnewaddress');
    }

    /** @return Collection<int, BitcoinTransactionEntity> */
    public function listTransactions(int $count = 100, int $skip = 0): Collection
    {   
        $transactions = $this->send('listtransactions', ['*', $count, $skip]);

        return collect($transactions)
            ->map(function (array $transactions) {
                return new BitcoinTransactionEntity(
                    hash: $transactions['txid'],
                    address: $transactions['address'],
                    category: BitcoinTransactionCategoryEnum::from($transactions['category']),
                    amount: $transactions['amount'],
                    confirmations: $transactions['confirmations'],
                );
            });
    }

    public function client(): BitcoinClient
    {
        return new BitcoinClient($this->config);
    }
    public function send(string $method, array $params = []): mixed
    {
        return $this->client()->send($method, $params);
    }
}
