<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Mediator;

class CalculateAverage
{
    public function __construct(
        private readonly GradeRepository $gradeRepository,
        private readonly AverageRepository $averageRepository
    ) {
    }

    public function execute(float $studentId): void
    {
        $grades = $this->gradeRepository->listByStudentId($studentId);
        $total = 0;
        foreach ($grades as $grade) {
            $total += $grade->value;
        }
        $averageValue =  count($grades) === 0 ? 0 : $total / count($grades);
        $average = new Average($studentId, $averageValue);
        $this->averageRepository->save($average);
    }
}
