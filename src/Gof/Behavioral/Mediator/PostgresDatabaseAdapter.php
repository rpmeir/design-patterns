<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Mediator;

use Dotenv\Dotenv;
use ErrorException;

class PostgresDatabaseAdapter implements DatabaseConnection
{
    private string $dbname;
    private string $host;
    private string $port;
    private ?\PDO $connection;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../../..');
        $dotenv->load();

        $this->dbname = $_ENV['DATABASE_NAME'];
        $this->host = $_ENV['DATABASE_HOST'];
        $this->port = $_ENV['DATABASE_PORT'];
        $dsn = "pgsql:dbname={$this->dbname};host={$this->host};port={$this->port}";

        $this->connection = new \PDO(
            $dsn,
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASS']
        );
    }

    public function query(string $statement, array $parameters): array
    {
        if (! $this->connection) {
            throw new ConnectionException('Connection not established');
        }
        $sth = $this->connection->prepare($statement);
        $sth->execute($parameters);
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function execute(string $statement, array $parameters): int
    {
        if (! $this->connection) {
            throw new ConnectionException('Connection not established');
        }
        $sth = $this->connection->prepare($statement);
        $sth->execute($parameters);
        return $sth->rowCount();
    }

    public function close(): void
    {
        $this->connection = null;
    }
}
