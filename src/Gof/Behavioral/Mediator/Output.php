<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Mediator;

class Output
{
    public function __construct(
        public readonly float $average
    ) {
    }
}
