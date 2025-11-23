<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Mediator;

interface GradeRepository
{
    public function save(Grade $grade): void;
    public function listByStudentId(float $studentId): array;
}
