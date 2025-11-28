<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Command;

class GetBalanceOutput
{
    public function __construct(
        public readonly float $balance
    ) {
    }
}
