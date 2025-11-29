<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Command;

interface Command
{
    public function execute(): void;
}
