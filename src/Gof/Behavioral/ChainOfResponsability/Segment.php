<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\ChainOfResponsability;

class Segment
{
    public function __construct(
        public readonly float $distance,
        public readonly \DateTime|false $date)
    {
        if ($this->isValidDistance() === false) {
            throw new \InvalidArgumentException('Distância inválida');
        }
        if ($this->isValidDate() === false) {
            throw new \InvalidArgumentException('Data inválida');
        }
    }

    public function isValidDistance(): bool
    {
        return $this->distance != null && is_numeric($this->distance) && $this->distance > 0;
    }

    public function isValidDate(): bool
    {
        return $this->date != null && $this->date instanceof \DateTimeInterface && $this->date !== false;
    }

    public function isOvernight(): bool
    {
        return $this->date->format('H:i') >= '22:00' || $this->date->format('H:i') <= '06:00';
    }

    public function isSunday(): bool
    {
        return $this->date->format('N') == 7;
    }
}
