<?php

declare(strict_types=1);

use function Src\Gof\Behavioral\ChainOfResponsability\calculateFare;

pest()->group('ChainOfResponsabilityTests');

describe('CalculateRideTest', function () {
    $dateString = '2021-03-31T10:00:00';

    test('Deve calcular o valor da corrida no horário normal', function () use ($dateString) {
        $movArray = [
            ['distance' => 10, 'date' => $dateString]
        ];

        $result = calculateFare($movArray);
        expect($result)->toBe(21.0);
    });

    test('Deve calcular o valor da corrida no horário noturno', function () {
        $movArray = [
            ['distance' => 10, 'date' => '2021-03-31T23:00:00']
        ];

        $result = calculateFare($movArray);
        expect($result)->toBe(39.0);
    });

    test('Deve calcular o valor da corrida no horário de domingo', function () {
        $movArray = [
            ['distance' => 10, 'date' => '2021-03-07T10:00:00']
        ];

        $result = calculateFare($movArray);
        expect($result)->toBe(29.0);
    });

    test('Deve calcular o valor da corrida no horário de domingo a noite', function () {
        $movArray = [
            ['distance' => 10, 'date' => '2021-03-07T23:00:00']
        ];

        $result = calculateFare($movArray);
        expect($result)->toBe(50.0);
    });

    test('Deve calcular o valor da corrida com tarifa mínima', function () use ($dateString) {
        $movArray = [
            ['distance' => 2, 'date' => $dateString]
        ];

        $result = calculateFare($movArray);
        expect($result)->toBe(10);
    });

    test('Não deve calcular o valor da corrida com distância inválida', function () use ($dateString) {
        $movArray = [
            ['distance' => -5, 'date' => $dateString]
        ];

        expect(fn() => calculateFare($movArray))
            ->toThrow( new \InvalidArgumentException('Distância inválida'));
    });

    test('Não deve calcular o valor da corrida com data inválida', function () {
        $movArray = [
            ['distance' => 10, 'date' => 'invalid-date']
        ];

        expect(fn() => calculateFare($movArray))
            ->toThrow(new \InvalidArgumentException('Data inválida'));
    });
});
