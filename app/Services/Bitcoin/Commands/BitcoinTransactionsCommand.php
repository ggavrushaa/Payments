<?php

namespace App\Services\Bitcoin\Commands;

use Illuminate\Console\Command;
use App\Services\Bitcoin\BitcoinConfig;
use App\Services\Bitcoin\BitcoinService;
use App\Services\Bitcoin\Models\BitcoinTransaction;
use App\Services\Bitcoin\Entities\BitcoinTransactionEntity;
use App\Services\Bitcoin\Enums\BitcoinTransactionStatusEnum;
use App\Services\Bitcoin\Events\BitcoinTransactionCompleted;

class BitcoinTransactionsCommand extends Command
{

    protected $signature = 'bitcoin:transactions';

    protected $description = 'Command description';

    public function handle(BitcoinService $bitcoin)
    {
        $this->warn('Обработка транзакций...');

        $transactions = $bitcoin->listTransactions(100);
        
        foreach($transactions as $transaction) {
            $this->processTransaction($transaction);
        }

        $this->info('Обработка транзакций завершена');
    }

    public function processTransaction(BitcoinTransactionEntity $entity): void
    {
        $transactions = $this->createTransaction($entity);

        $this->checkTransactionStatus($transactions, $entity);
    }
    public function createTransaction(BitcoinTransactionEntity $entity): BitcoinTransaction
    {
        return BitcoinTransaction::query()
        ->firstOrCreate([
            'hash' => $entity->hash,
            'address' => $entity->address,
            'category' => $entity->category,
        ], [
            'amount' => $entity->amount,
            'confirmations' => $entity->confirmations,
            'status' => BitcoinTransactionStatusEnum::pending->value,
        ]);
    }

    private function checkTransactionStatus(
        BitcoinTransaction $transaction, 
        BitcoinTransactionEntity $entity
        ): void
    {
        if($transaction->status->isNotPending()) {
            return;
        }

        if($transaction->confirmations < $entity->confirmations) {
            $transaction->update(['confirmations' => $entity->confirmations]);
        }

        if($transaction->confirmations < config('services.bitcoin.confirmations')) {
            return;
        }

        $transaction->update(['status' => BitcoinTransactionStatusEnum::completed]);

        event(new BitcoinTransactionCompleted($entity));

    }
}
