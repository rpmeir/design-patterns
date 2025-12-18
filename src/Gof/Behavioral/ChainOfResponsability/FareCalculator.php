<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\ChainOfResponsability;

interface FareCalculator
{
    public ?FareCalculator $next { get; }
    public function calculate(Segment $segment): float;
}
