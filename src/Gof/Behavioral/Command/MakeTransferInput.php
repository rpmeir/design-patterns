<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Command;

class MakeTransferInput
{
    public function __construct(
        public readonly int $fromAccountId,
        public readonly int $toAccountId,
        public readonly float $amount
    ) {
    }
}
