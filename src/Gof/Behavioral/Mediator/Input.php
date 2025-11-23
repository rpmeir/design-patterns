<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Mediator;

class Input
{
    public function __construct(
        public readonly float $studentId,
        public readonly string $exam,
        public readonly float $value
    ) {
    }
}
