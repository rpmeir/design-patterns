<?php

namespace Src\Gof\Behavioral\Strategy;

use DateTimeImmutable;

class ParkingTicket
{
    private float $fare;
    private ?DateTimeImmutable $checkoutDate;

    public function __construct(
        public readonly string $plate,
        public readonly DateTimeImmutable $checkinDate,
        public readonly string $location
    ) {
        $this->fare = 0;
        $this->checkoutDate = null;
    }

    public function getFare(): float
    {
        return $this->fare;
    }

    public function setFare(float $fare): void
    {
        $this->fare = $fare;
    }

    public function getCheckoutDate(): ?DateTimeImmutable
    {
        return $this->checkoutDate;
    }

    public function setCheckoutDate(DateTimeImmutable $checkoutDate): void
    {
        $this->checkoutDate = $checkoutDate;
    }

    public function checkout(DateTimeImmutable $checkoutDate): void
    {
        if ($this->checkoutDate !== null) {
            throw new VehicleAlreadyCheckoutException('Vehicle already checkout');
        }
        $this->checkoutDate = $checkoutDate;
        $fareCalculator = FareCalculatorFactory::create($this->location);
        $this->fare = $fareCalculator->calculate($this->checkinDate, $checkoutDate);
    }
}
