<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Command;

class BankAccount
{
    /** @var array<Transaction> */
    private array $transactions;

    public function __construct(public readonly int $bankAccountId = 0)
    {
        $this->transactions = [];
    }

    public function debit(float $amount): void
    {
        $this->transactions[] = new Transaction('debit', $amount);
    }

    public function credit(float $amount): void
    {
        $this->transactions[] = new Transaction('credit', $amount);
    }

    public function getBalance(): float
    {
        $balance = 0.0;
        foreach ($this->transactions as $transaction) {
            if ($transaction->type === 'debit') {
                $balance -= $transaction->amount;
            } elseif ($transaction->type === 'credit') {
                $balance += $transaction->amount;
            }
        }
        return $balance;
    }
}
