<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\ChainOfResponsability;

class SundayFareCalculator implements FareCalculator
{
    const FARE_PER_KM = 2.90;

    public function __construct(public readonly ?FareCalculator $next = null)
    {
    }

    public function calculate(Segment $segment): float
    {
        if ($segment->isSunday() && !$segment->isOvernight()) {
            return $segment->distance * self::FARE_PER_KM;
        }
        if ($this->next !== null) {
            return $this->next->calculate($segment);
        }
        throw new NoFareCalculatorException('No fare calculator available for this segment');
    }
}
