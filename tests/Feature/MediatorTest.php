<?php

use Src\Gof\Behavioral\Mediator\AverageRepositoryDatabase;
use Src\Gof\Behavioral\Mediator\CalculateAverage;
use Src\Gof\Behavioral\Mediator\GetAverage;
use Src\Gof\Behavioral\Mediator\GradeRepositoryDatabase;
use Src\Gof\Behavioral\Mediator\Input;
use Src\Gof\Behavioral\Mediator\Mediator;
use Src\Gof\Behavioral\Mediator\PostgresDatabaseAdapter;
use Src\Gof\Behavioral\Mediator\SaveGrade;
use Src\Gof\Behavioral\Mediator\SaveGradeMediator;

test('Deve salvar a nota do aluno e calcular a média', function () {
    $studentId = mt_rand(100000, 200000);
    $connection = new PostgresDatabaseAdapter();
    $gradeRepository = new GradeRepositoryDatabase($connection);
    $averageRepository = new AverageRepositoryDatabase($connection);
    $calculateAverage = new CalculateAverage($gradeRepository, $averageRepository);
    $saveGrade = new SaveGrade($gradeRepository, $calculateAverage);
    $inputP1 = new Input($studentId, 'P1', 10.0);
    $saveGrade->execute($inputP1);
    $inputP2 = new Input($studentId, 'P2', 9.0);
    $saveGrade->execute($inputP2);
    $inputP3 = new Input($studentId, 'P3', 8.0);
    $saveGrade->execute($inputP3);

    $getAverage = new GetAverage($averageRepository);
    $output = $getAverage->execute($studentId);

    expect($output->average)->toBe(9.0);
});

test('Deve salvar a nota do aluno e calcular a média usando mediator', function () {
    $studentId = mt_rand(100000, 200000);
    $connection = new PostgresDatabaseAdapter();
    $gradeRepository = new GradeRepositoryDatabase($connection);
    $averageRepository = new AverageRepositoryDatabase($connection);
    $calculateAverage = new CalculateAverage($gradeRepository, $averageRepository);
    $mediator = new Mediator();
    $mediator->register('gradeSaved', function (array $data) use ($calculateAverage) {
        $calculateAverage->execute($data['studentId']);
    });
    $saveGrade = new SaveGradeMediator($gradeRepository, $mediator);
    $inputP1 = new Input($studentId, 'P1', 10.0);
    $saveGrade->execute($inputP1);
    $inputP2 = new Input($studentId, 'P2', 9.0);
    $saveGrade->execute($inputP2);
    $inputP3 = new Input($studentId, 'P3', 8.0);
    $saveGrade->execute($inputP3);

    $getAverage = new GetAverage($averageRepository);
    $output = $getAverage->execute($studentId);

    expect($output->average)->toBe(9.0);
});
