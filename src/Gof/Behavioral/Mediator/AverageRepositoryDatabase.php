<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Mediator;

class AverageRepositoryDatabase implements AverageRepository
{
    private DatabaseConnection $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    public function save(Average $average): void
    {
        $this->connection->execute(
            'DELETE FROM design_patterns.averages WHERE student_id = :student_id',
            ['student_id' => $average->studentId]
        );
        $this->connection->execute(
            'INSERT INTO design_patterns.averages (student_id, value) VALUES (:student_id, :value)',
            [
                'student_id' => $average->studentId,
                'value' => $average->value,
            ]
        );
    }

    public function findByStudentId(float $studentId): ?Average
    {
        $results = $this->connection->query(
            'SELECT * FROM design_patterns.averages WHERE student_id = :student_id',
            ['student_id' => $studentId]
        );

        if (empty($results)) {
            return null;
        }

        $row = $results[0];
        return new Average(
            (float)$row['student_id'],
            (float)$row['value']
        );
    }
}
