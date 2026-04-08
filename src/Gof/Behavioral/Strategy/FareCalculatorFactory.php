<?php

namespace Src\Gof\Behavioral\Strategy;

class FareCalculatorFactory
{
    public static function create(string $location): FareCalculator
    {
        try {
            return match ($location) {
                'airport' => new AirportFareCalculator(),
                'beach' => new BeachFareCalculator(),
                'shopping' => new ShoppingFareCalculator(),
                'public' => new PublicFareCalculator()
            };
        } catch (\UnhandledMatchError $e) {
            throw new \InvalidArgumentException("Invalid location: $location. Message: " . $e->getMessage(), previous: $e);
        }
    }
}
