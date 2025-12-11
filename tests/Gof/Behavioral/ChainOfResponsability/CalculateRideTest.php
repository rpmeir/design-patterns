<?php

declare(strict_types=1);

use function Src\Gof\Behavioral\ChainOfResponsability\calc;

pest()->group('ChainOfResponsabilityTests');

describe('CalculateRideTest', function () {
    test('Deve calcular o valor da corrida no horário normal', function () {
        $movArray = [
            ['dist' => 10, 'ds' => '2021-03-31T10:00:00']
        ];

        $result = calc($movArray);
        expect($result)->toBe(21.0);
    });

    test('Deve calcular o valor da corrida no horário noturno', function () {
        $movArray = [
            ['dist' => 10, 'ds' => '2021-03-31T23:00:00']
        ];

        $result = calc($movArray);
        expect($result)->toBe(39.0);
    });

    test('Deve calcular o valor da corrida no horário de domingo', function () {
        $movArray = [
            ['dist' => 10, 'ds' => '2021-03-07T10:00:00']
        ];

        $result = calc($movArray);
        expect($result)->toBe(29.0);
    });

    test('Deve calcular o valor da corrida no horário de domingo a noite', function () {
        $movArray = [
            ['dist' => 10, 'ds' => '2021-03-07T23:00:00']
        ];

        $result = calc($movArray);
        expect($result)->toBe(50.0);
    });

    test('Deve calcular o valor da corrida com tarifa mínima', function () {
        $movArray = [
            ['dist' => 2, 'ds' => '2021-03-31T10:00:00']
        ];

        $result = calc($movArray);
        expect($result)->toBe(10);
    });

    test('Não deve calcular o valor da corrida com distância inválida', function () {
        $movArray = [
            ['dist' => -5, 'ds' => '2021-03-31T10:00:00']
        ];

        $result = calc($movArray);
        expect($result)->toBe(-1);
    });

    test('Não deve calcular o valor da corrida com data inválida', function () {
        $movArray = [
            ['dist' => 10, 'ds' => 'invalid-date']
        ];

        $result = calc($movArray);
        expect($result)->toBe(-2);
    });
});
