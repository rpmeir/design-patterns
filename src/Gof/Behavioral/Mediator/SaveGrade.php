<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Mediator;

class SaveGrade
{
    public function __construct(
        private readonly GradeRepository $gradeRepository,
        private readonly CalculateAverage $calculateAverage
    ) {
    }

    public function execute(Input $input): void
    {
        $grade = new Grade($input->studentId, $input->exam, $input->value);
        $this->gradeRepository->save($grade);
        $this->calculateAverage->execute($input->studentId);
    }
}
