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
        $transferCommand = new TransferCommand($from, $to, $input->amount);
        $transferCommand->execute();
        $this->bankAccountRepository->update($from);
        $this->bankAccountRepository->update($to);
    }
}
