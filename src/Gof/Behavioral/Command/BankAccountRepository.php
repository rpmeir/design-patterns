<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Command;

interface BankAccountRepository
{
    public function save(BankAccount $account): void;
    public function update(BankAccount $account): void;
    public function getById(int $id): ?BankAccount;
}
