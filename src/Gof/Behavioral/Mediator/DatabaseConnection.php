<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Mediator;

interface DatabaseConnection
{
    public function query(string $statement, array $parameters): array;
    public function execute(string $statement, array $parameters): int;
    public function close(): void;
}
