<?php

declare(strict_types=1);

use Src\Gof\Behavioral\ChainOfResponsability\Ride;

pest()->group('ChainOfResponsabilityTests');

describe('CalculateRideTest', function () {
    $ride = null;

    beforeEach(function () use (&$ride)  {
        $overnightSundayFareCalculator = new \Src\Gof\Behavioral\ChainOfResponsability\OvernightSundayFareCalculator();
        $sundayFareCalculator = new \Src\Gof\Behavioral\ChainOfResponsability\SundayFareCalculator($overnightSundayFareCalculator);
        $overnightFareCalculator = new \Src\Gof\Behavioral\ChainOfResponsability\OvernightFareCalculator($sundayFareCalculator);
        $normalFareCalculator = new \Src\Gof\Behavioral\ChainOfResponsability\NormalFareCalculator($overnightFareCalculator);
        $ride = new Ride($normalFareCalculator);
    });

    test('Deve calcular o valor da corrida no horário normal', function () use (&$ride) {
        $ride->addSegment(10, \date_create('2021-03-01T10:00:00'));
        $ride->calculateFare();
        expect($ride->getFare())->toBe(21.0);
    });

    test('Deve calcular o valor da corrida no horário noturno', function () use (&$ride) {
        $ride->addSegment(10, \date_create('2021-03-01T23:00:00'));
        $ride->calculateFare();
        expect($ride->getFare())->toBe(39.0);
    });

    test('Deve calcular o valor da corrida no horário de domingo', function () use (&$ride) {
        $ride->addSegment(10, \date_create('2021-03-07T10:00:00'));
        $ride->calculateFare();
        expect($ride->getFare())->toBe(29.0);
    });

    test('Deve calcular o valor da corrida no horário de domingo de noite', function () use (&$ride) {
        $ride->addSegment(10, \date_create('2021-03-07T23:00:00'));
        $ride->calculateFare();
        expect($ride->getFare())->toBe(50.0);
    });

    test('Deve calcular o valor da corrida com tarifa mínima', function () use (&$ride) {
        $ride->addSegment(2, \date_create('2021-03-31T10:00:00'));
        $ride->calculateFare();
        expect($ride->getFare())->toBe(10.0);
    });

    test('Não deve calcular o valor da corrida com distância inválida', function () use (&$ride) {
        expect(fn() => $ride->addSegment(-10, \date_create('2021-03-01T10:00:00')))
            ->toThrow( new \InvalidArgumentException('Distância inválida'));
    });

    test('Não deve calcular o valor da corrida com data inválida', function () use (&$ride) {
        expect(fn() => $ride->addSegment(10, \date_create('invalid-date')))
            ->toThrow( new \InvalidArgumentException('Data inválida'));
    });
});
