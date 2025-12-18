<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\ChainOfResponsability;

class Ride
{
    private array $segments = [];
    private float $fare;

    public function __construct()
    {
        $this->segments = [];
        $this->fare = 0;
    }

    public function addSegment(float $distance, \DateTime $date): void
    {
        $this->segments[] = new Segment($distance, $date);
    }

    public function calculateFare(): void
    {
        $this->fare = 0;
        foreach ($this->segments as $segment) {
            if ($segment->isOvernight() && !$segment->isSunday()) {
                $this->fare += $segment->distance * 3.90;
            }
            if ($segment->isOvernight() && $segment->isSunday()) {
                $this->fare += $segment->distance * 5.0;
            }
            if (!$segment->isOvernight() && $segment->isSunday()) {
                $this->fare += $segment->distance * 2.9;
            }
            if (!$segment->isOvernight() && !$segment->isSunday()) {
                $this->fare += $segment->distance * 2.10;
            }
        }
        $this->fare = $this->fare < 10 ? 10 : $this->fare;
    }

    public function getFare(): float
    {
        return $this->fare;
    }
}
