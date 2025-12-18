<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\ChainOfResponsability;

class Ride
{
    private array $segments = [];
    private float $fare;

    public function __construct(public readonly FareCalculator $fareCalculator)
    {
        $this->segments = [];
        $this->fare = 0;
    }

    public function addSegment(float $distance, \DateTime|false $date): void
    {
        $this->segments[] = new Segment($distance, $date);
    }

    public function calculateFare(): void
    {
        $this->fare = 0;
        foreach ($this->segments as $segment) {
            $this->fare += $this->fareCalculator->calculate($segment);
        }
        $this->fare = $this->fare < 10 ? 10 : $this->fare;
    }

    public function getFare(): float
    {
        return $this->fare;
    }
}
