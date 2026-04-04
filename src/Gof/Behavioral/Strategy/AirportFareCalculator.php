<?php

namespace Src\Gof\Behavioral\Strategy;

class AirportFareCalculator implements FareCalculator
{
    public function calculate(\DateTimeImmutable $checkinDate, \DateTimeImmutable $checkoutDate): float
    {
        $interval = $checkinDate->diff($checkoutDate);
        $hours = (int) ceil($interval->h + ($interval->days * 24));
        return $hours * 10.0;
    }
}
