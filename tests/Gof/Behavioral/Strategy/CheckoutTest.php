<?php

declare(strict_types=1);

use Src\Gof\Behavioral\Strategy\Checkin;
use Src\Gof\Behavioral\Strategy\CheckinInput;
use Src\Gof\Behavioral\Strategy\Checkout;
use Src\Gof\Behavioral\Strategy\CheckoutInput;
use Src\Gof\Behavioral\Strategy\ParkingTicketRepositoryDatabase;
use Src\Gof\Behavioral\Strategy\PostgresDatabaseAdapter;

pest()->group('StrategyTests');

describe('CheckoutTest', function () {

    $commomCheckinDate = new \DateTimeImmutable('2023-03-01T10:00:00');

    test('Deve calcular a tarifa do veículo estacionado no aeroporto', function () use ($commomCheckinDate) {
        $plate = 'AAA' . str_pad((string) random_int(1000, 9999), 4, "0", STR_PAD_LEFT);
        $connection  = new PostgresDatabaseAdapter();
        $parkingTicketRepository = new ParkingTicketRepositoryDatabase($connection);
        $checkin = new Checkin($parkingTicketRepository);
        $inputCheckin =  new CheckinInput(
             plate: $plate,
             checkinDate: $commomCheckinDate,
             location: 'airport'
        );
        $checkin->execute($inputCheckin);
        $checkout = new Checkout($parkingTicketRepository);
        $inputCheckout = new CheckoutInput(
            plate: $plate,
            checkoutDate: new \DateTimeImmutable('2023-03-01T12:00:00')
        );
        $output = $checkout->execute($inputCheckout);
        expect($output->fare)->toBe(20.0);
    });

    test('Deve calcular a tarifa do veículo estacionado no shopping', function () use ($commomCheckinDate) {
        $plate = 'AAA' . str_pad((string) random_int(1000, 9999), 4, "0", STR_PAD_LEFT);
        $connection  = new PostgresDatabaseAdapter();
        $parkingTicketRepository = new ParkingTicketRepositoryDatabase($connection);
        $checkin = new Checkin($parkingTicketRepository);
        $inputCheckin =  new CheckinInput(
             plate: $plate,
             checkinDate: $commomCheckinDate,
             location: 'shopping'
        );
        $checkin->execute($inputCheckin);
        $checkout = new Checkout($parkingTicketRepository);
        $inputCheckout = new CheckoutInput(
            plate: $plate,
            checkoutDate: new \DateTimeImmutable('2023-03-01T15:00:00')
        );
        $output = $checkout->execute($inputCheckout);
        expect($output->fare)->toBe(30.0);
    });

    test('Deve calcular a tarifa do veículo estacionado na praia', function () use ($commomCheckinDate) {
        $plate = 'AAA' . str_pad((string) random_int(1000, 9999), 4, "0", STR_PAD_LEFT);
        $connection  = new PostgresDatabaseAdapter();
        $parkingTicketRepository = new ParkingTicketRepositoryDatabase($connection);
        $checkin = new Checkin($parkingTicketRepository);
        $inputCheckin =  new CheckinInput(
             plate: $plate,
             checkinDate: $commomCheckinDate,
             location: 'beach'
        );
        $checkin->execute($inputCheckin);
        $checkout = new Checkout($parkingTicketRepository);
        $inputCheckout = new CheckoutInput(
            plate: $plate,
            checkoutDate: new \DateTimeImmutable('2023-03-01T17:00:00')
        );
        $output = $checkout->execute($inputCheckout);
        expect($output->fare)->toBe(10.0);
    });

    test('Deve calcular a tarifa do veículo estacionado na rua', function () use ($commomCheckinDate) {
        $plate = 'AAA' . str_pad((string) random_int(1000, 9999), 4, "0", STR_PAD_LEFT);
        $connection  = new PostgresDatabaseAdapter();
        $parkingTicketRepository = new ParkingTicketRepositoryDatabase($connection);
        $checkin = new Checkin($parkingTicketRepository);
        $inputCheckin =  new CheckinInput(
             plate: $plate,
             checkinDate: $commomCheckinDate,
             location: 'public'
        );
        $checkin->execute($inputCheckin);
        $checkout = new Checkout($parkingTicketRepository);
        $inputCheckout = new CheckoutInput(
            plate: $plate,
            checkoutDate: new \DateTimeImmutable('2023-03-01T17:00:00')
        );
        $output = $checkout->execute($inputCheckout);
        expect($output->fare)->toBe(0.0);
    });
});
