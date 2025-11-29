<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Command;

class TransferCommand implements Command
{
    public function __construct(
        private readonly BankAccount $from,
        private readonly BankAccount $to,
        private readonly float $amount
    ) {
    }

    public function execute(): void
    {
        $this->from->debit($this->amount);
        $this->to->credit($this->amount);
    }
}
