<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Mediator;

class GradeRepositoryInMemory implements GradeRepository
{
    /** @var Grade[] */
    private array $grades = [];

    public function save(Grade $grade): void
    {
        $this->grades[$grade->studentId][] = $grade;
    }

    public function listByStudentId(float $studentId): array
    {
        return $this->grades[$studentId] ?? [];
    }
}
