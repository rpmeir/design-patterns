<?php

declare(strict_types=1);

use Src\Gof\Behavioral\ChainOfResponsability\Ride;

pest()->group('ChainOfResponsabilityTests');

describe('CalculateRideTest', function () {
    $dateString = '2021-03-01T10:00:00';

    test('Deve calcular o valor da corrida no horário normal', function () {
        $ride = new Ride();
        $ride->addSegment(10, \date_create('2021-03-01T10:00:00'));
        $ride->calculateFare();
        expect($ride->getFare())->toBe(21.0);
    });

    test('Deve calcular o valor da corrida no horário noturno', function () {
        $ride = new Ride();
        $ride->addSegment(10, \date_create('2021-03-01T23:00:00'));
        $ride->calculateFare();
        expect($ride->getFare())->toBe(39.0);
    });

    test('Não deve calcular o valor da corrida com distância inválida', function () {
        $ride = new Ride();

        expect(fn() => $ride->addSegment(-10, \date_create('2021-03-01T10:00:00')))
            ->toThrow( new \InvalidArgumentException('Distância inválida'));
    });
});
