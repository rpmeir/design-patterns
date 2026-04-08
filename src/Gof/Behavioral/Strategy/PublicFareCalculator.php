<?php

namespace Src\Gof\Behavioral\Strategy;

class PublicFareCalculator implements FareCalculator
{
    public function calculate(\DateTimeImmutable $checkinDate, \DateTimeImmutable $checkoutDate): float
    {
        return 0.0;
    }
}
