<?php

declare(strict_types=1);
use Src\Gof\Behavioral\Command\BankAccount;

describe('CommandTest', function () {
    it('Deve fazer uma transferência entre duas contas', function () {
        $bankAccountA =  new BankAccount();
        $bankAccountB =  new BankAccount();
        expect($bankAccountA->getBalance())->toBe(0.0);
        expect($bankAccountB->getBalance())->toBe(0.0);
        $bankAccountA->debit(100);
        $bankAccountB->credit(100);
        expect($bankAccountA->getBalance())->toBe(-100.0);
        expect($bankAccountB->getBalance())->toBe(100.0);
    });
});
