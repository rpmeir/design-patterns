<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Mediator;

class Average
{
    public function __construct(
        public readonly float $studentId,
        public readonly float $value
    ) {
    }
}
