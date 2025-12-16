<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\ChainOfResponsability;

function calculateFare ($segments)
{
    $fare = 0;
    foreach ($segments as $segment) {
        if (!isValidDistance($segment['distance'])) { throw new \InvalidArgumentException('Distância inválida'); }
        $date = \date_create($segment['date']);
        if (!isValidDate($date)) { throw new \InvalidArgumentException('Data inválida'); }
        if (isOvernight($date) && !isSunday($date)) {
            $fare += $segment['distance'] * 3.90;
        }
        if (isOvernight($date) && isSunday($date)) {
            $fare += $segment['distance'] * 5.0;
        }
        if (!isOvernight($date) && isSunday($date)) {
            $fare += $segment['distance'] * 2.9;
        }
        if (!isOvernight($date) && !isSunday($date)) {
            $fare += $segment['distance'] * 2.10;
        }
    }
    return $fare < 10 ? 10 : $fare;
}

function isValidDistance($distance): bool
{
    return $distance != null && is_numeric($distance) && $distance > 0;
}

function isValidDate($date): bool
{
    return $date != null && $date instanceof \DateTime && $date != false;
}

function isOvernight($date): bool
{
    return $date->format('H:i') >= '22:00' || $date->format('H:i') <= '06:00';
}

function isSunday($date): bool
{
    return $date->format('N') == 7;
}
