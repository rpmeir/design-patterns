<?php

declare(strict_types=1);
use Src\Gof\Behavioral\Command\BankAccount;
use Src\Gof\Behavioral\Command\TransferCommand;

pest()->group('CommandTests');

describe('CommandTest', function () {
    it('Deve fazer uma transferência entre duas contas', function () {
        $from =  new BankAccount();
        $to =  new BankAccount();
        expect($from->getBalance())->toBe(0.0);
        expect($to->getBalance())->toBe(0.0);
        $from->debit(100);
        $to->credit(100);
        expect($from->getBalance())->toBe(-100.0);
        expect($to->getBalance())->toBe(100.0);
    });

    it('Deve fazer uma transferência entre duas contas usando um comando', function () {
        $from =  new BankAccount();
        $to =  new BankAccount();
        expect($from->getBalance())->toBe(0.0);
        expect($to->getBalance())->toBe(0.0);
        $transferCommand = new TransferCommand($from, $to, 100);
        $transferCommand->execute();
        expect($from->getBalance())->toBe(-100.0);
        expect($to->getBalance())->toBe(100.0);
    });
});
