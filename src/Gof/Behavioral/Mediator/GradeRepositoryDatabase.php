<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Mediator;

class GradeRepositoryDatabase implements GradeRepository
{
    private DatabaseConnection $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    public function save(Grade $grade): void
    {
        $this->connection->execute(
            'INSERT INTO design_patterns.grades (student_id, exam, value) VALUES (:student_id, :exam, :value)',
            [
                'student_id' => $grade->studentId,
                'exam' => $grade->exam,
                'value' => $grade->value,
            ]
        );
    }

    public function listByStudentId(float $studentId): array
    {
        $results = $this->connection->query(
            'SELECT * FROM design_patterns.grades WHERE student_id = :student_id',
            ['student_id' => $studentId]
        );

        $grades = [];
        foreach ($results as $row) {
            $grades[] = new Grade(
                (float)$row['student_id'],
                $row['exam'],
                (float)$row['value']
            );
        }
        return $grades;
    }
}
