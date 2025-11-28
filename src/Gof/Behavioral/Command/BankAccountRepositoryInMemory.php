<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Command;

class BankAccountRepositoryInMemory implements BankAccountRepository
{
    private array $accounts = [];

    public function save(BankAccount $account): void
    {
        if (isset($this->accounts[$account->bankAccountId])) {
            throw new \InvalidArgumentException("Bank account with ID {$account->bankAccountId} already exists.");
        }
        $this->accounts[$account->bankAccountId] = $account;
    }

    public function update(BankAccount $account): void
    {
        if (!isset($this->accounts[$account->bankAccountId])) {
            throw new \InvalidArgumentException("Bank account with ID {$account->bankAccountId} not found.");
        }
        $this->accounts[$account->bankAccountId] = $account;
    }

    public function getById(int $id): ?BankAccount
    {
        if (!isset($this->accounts[$id])) {
            throw new \InvalidArgumentException("Bank account with ID $id not found.");
        }
        return $this->accounts[$id];
    }
}
