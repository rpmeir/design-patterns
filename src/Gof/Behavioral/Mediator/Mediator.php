<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Mediator;

class Mediator
{
    private array $handlers = [];

    public function register(string $event, callable $callback): void
    {
        $this->handlers[$event][] = $callback;
    }

    public function notify(string $event, array $data = []): void
    {
        if (!isset($this->handlers[$event])) {
            return;
        }

        foreach ($this->handlers[$event] as $handler) {
            $handler($data);
        }
    }
}
