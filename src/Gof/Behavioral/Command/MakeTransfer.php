<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\Command;

class MakeTransfer
{
    public function __construct(
        private readonly BankAccountRepository $bankAccountRepository
    ) {
    }

    public function execute(MakeTransferInput $input): void
    {
        $from = $this->bankAccountRepository->getById($input->fromAccountId);
        $to = $this->bankAccountRepository->getById($input->toAccountId);
        $from->debit($input->amount);
        $to->credit($input->amount);
        $this->bankAccountRepository->update($from);
        $this->bankAccountRepository->update($to);
    }
}
