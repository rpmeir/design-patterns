<?php

namespace Src\Gof\Behavioral\Strategy;

class BeachFareCalculator implements FareCalculator
{
    public function calculate(\DateTimeImmutable $checkinDate, \DateTimeImmutable $checkoutDate): float
    {
        return 10.0;
    }
}
