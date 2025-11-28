<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Command;

class Transaction
{
    public function __construct(
        public readonly string $type,
        public readonly float $amount
    ) {
        if (!in_array($type, ['credit', 'debit'], true)) {
            throw new \InvalidArgumentException('Type must be "credit" or "debit".');
        }
    }
}
