<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Mediator;

class GetAverage
{
    public function __construct(
        private readonly AverageRepository $averageRepository
    ) {
    }

    public function execute(float $studentId): ?Output
    {
        $average = $this->averageRepository->findByStudentId($studentId);
        if ($average === null) {
            return null;
        }
        return new Output($average->value);
    }
}
