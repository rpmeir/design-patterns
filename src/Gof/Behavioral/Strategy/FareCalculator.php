<?php

namespace Src\Gof\Behavioral\Strategy;

interface FareCalculator
{
    public function calculate(\DateTimeImmutable $checkinDate, \DateTimeImmutable $checkoutDate): float;
}
