<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Mediator;

class AverageRepositoryInMemory implements AverageRepository
{
    /** @var Average[] */
    private array $averages = [];

    public function save(Average $average): void
    {
        $this->averages[$average->studentId] = $average;
    }

    public function findByStudentId(float $studentId): ?Average
    {
        return $this->averages[$studentId] ?? null;
    }
}
