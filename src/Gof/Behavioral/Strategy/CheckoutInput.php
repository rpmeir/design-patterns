<?php

namespace Src\Gof\Behavioral\Strategy;

class CheckoutInput
{
    public function __construct(
        public readonly string $plate,
        public readonly \DateTimeImmutable $checkoutDate
    ) {
    }
}
