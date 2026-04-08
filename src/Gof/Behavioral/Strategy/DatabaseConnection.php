<?php

namespace Src\Gof\Behavioral\Strategy;

interface DatabaseConnection
{
    public function query(string $statement, array $parameters): array;
    public function execute(string $statement, array $parameters): int;
    public function close(): void;
}
