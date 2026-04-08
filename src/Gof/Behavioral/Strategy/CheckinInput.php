<?php

namespace Src\Gof\Behavioral\Strategy;

use DateTimeImmutable;

class CheckinInput
{
    public function __construct(
        public readonly string $plate,
        public readonly DateTimeImmutable $checkinDate,
        public readonly string $location
    ) {
    }
}
