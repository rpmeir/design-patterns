<?php

namespace Src\Gof\Behavioral\Strategy;

class CheckoutOutput
{
    public function __construct(
        public readonly string $plate,
        public readonly float $fare
    ) {
    }
}
