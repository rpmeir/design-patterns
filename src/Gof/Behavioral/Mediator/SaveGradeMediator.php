<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Mediator;

class SaveGradeMediator
{
    public function __construct(
        private readonly GradeRepository $gradeRepository,
        private readonly Mediator $mediator
    ) {
    }

    public function execute(Input $input): void
    {
        $grade = new Grade($input->studentId, $input->exam, $input->value);
        $this->gradeRepository->save($grade);
        $this->mediator->notify('gradeSaved', ['studentId' => $input->studentId]);
    }
}
