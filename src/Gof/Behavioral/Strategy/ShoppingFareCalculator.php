<?php

namespace Src\Gof\Behavioral\Strategy;

class ShoppingFareCalculator implements FareCalculator
{
    public function calculate(\DateTimeImmutable $checkinDate, \DateTimeImmutable $checkoutDate): float
    {
        $interval = $checkinDate->diff($checkoutDate);
        $hours = (int) ceil($interval->h + ($interval->days * 24));
        $fare = 10;
        $remainingHours = $hours - 3;
        if ($remainingHours > 0) {
            $fare += $remainingHours * 10;
        }
        return $fare;
    }
}
