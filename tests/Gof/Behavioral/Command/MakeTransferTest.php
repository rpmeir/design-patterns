<?php

declare(strict_types=1);
use Src\Gof\Behavioral\Command\BankAccount;
use Src\Gof\Behavioral\Command\BankAccountRepositoryInMemory;
use Src\Gof\Behavioral\Command\GetBalance;
use Src\Gof\Behavioral\Command\MakeTransfer;
use Src\Gof\Behavioral\Command\MakeTransferInput;

describe('MakeTransferTest', function () {
    it('Deve fazer uma tranferência bancária', function () {
        $bankAccountRepository = new BankAccountRepositoryInMemory();
        $bankAccountRepository->save(new BankAccount(1));
        $bankAccountRepository->save(new BankAccount(2));
        $makeTransfer = new MakeTransfer($bankAccountRepository);
        $input = new MakeTransferInput(
            fromAccountId: 1,
            toAccountId: 2,
            amount: 100.0
        );
        $makeTransfer->execute($input);
        $getBalance = new GetBalance($bankAccountRepository);
        $outputA = $getBalance->execute( 1);
        expect($outputA->balance)->toBe(-100.0);
        $outputB = $getBalance->execute(2);
        expect($outputB->balance)->toBe(100.0);
    })->only();
});
