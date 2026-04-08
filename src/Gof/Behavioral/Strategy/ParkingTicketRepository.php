<?php

namespace Src\Gof\Behavioral\Strategy;

interface ParkingTicketRepository
{
    public function getByPlate(string $plate): ?ParkingTicket;

    public function save(ParkingTicket $parkingTicket): void;

    public function update(ParkingTicket $parkingTicket): void;
}
