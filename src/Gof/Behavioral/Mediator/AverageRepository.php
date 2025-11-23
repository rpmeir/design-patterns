<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Mediator;

interface AverageRepository
{
    public function save(Average $average): void;
    public function findByStudentId(float $studentId): ?Average;
}
