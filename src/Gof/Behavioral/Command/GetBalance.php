<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Command;

class GetBalance
{
    public function __construct(
        private readonly BankAccountRepository $bankAccountRepository
    ) {
    }

    public function execute(int $accountId): GetBalanceOutput
    {
        $account = $this->bankAccountRepository->getById($accountId);
        return $account ? new GetBalanceOutput($account->getBalance()) : new GetBalanceOutput(0.0);
    }
}
