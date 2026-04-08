<?php

declare(strict_types=1);

use Src\Gof\Behavioral\Strategy\ParkingTicket;

pest()->group('StrategyTests');

describe('ParkingTicketTest', function () {
    test('Deve calcular a tarifa do veículo estacionado no aeroporto', function () {
        $plate = 'AAA' . str_pad((string) random_int(1000, 9999), 4, "0", STR_PAD_LEFT);
        $parkingTicket = new ParkingTicket(
            plate: $plate,
            checkinDate: new \DateTimeImmutable('2023-03-01T10:00:00'),
            location: 'airport'
        );
        $parkingTicket->checkout(new \DateTimeImmutable('2023-03-01T12:00:00'));
        expect($parkingTicket->getFare())->toBe(20.0);
    });
});
