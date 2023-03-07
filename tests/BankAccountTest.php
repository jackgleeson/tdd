<?php


use Jack\Tdd\BankAccount;
use PHPUnit\Framework\TestCase;

class BankAccountTest extends TestCase
{
    public function testBankAccountCreated(): void
    {
        $bankAccount = new BankAccount();
        $newAccount = $bankAccount::newAccount("Jack", "Gleeson", 2.0);
        $this->assertEquals("Open", $newAccount->getStatus());
    }

    // test setting balance to 10
    public function testSetBalance(): void
    {
        $bankAccount = new BankAccount();
        $newAccount = $bankAccount::newAccount("Jack", "Gleeson", 2.0);
        $newAccount->setBalance(10);
        $this->assertEquals(10, $newAccount->getBalance());
    }

    // test reducing balance by 5
    public function testReduceBalance(): void
    {
        $bankAccount = new BankAccount();
        $newAccount = $bankAccount::newAccount("Jack", "Gleeson", 2.0);
        $newAccount->setBalance(10);
        $newAccount->reduceBalance(5);
        $this->assertEquals(5, $newAccount->getBalance());
    }

    // test set interest rate
    public function testSetInterestRate(): void
    {
        $bankAccount = new BankAccount();
        $newAccount = $bankAccount::newAccount("Jack", "Gleeson", 2.0);
        $newAccount->setInterestRate(4.0);
        $this->assertEquals(4.0, $newAccount->getInterestRate());
    }

    // test paying interest
    public function testPayInterest(): void
    {
        $bankAccount = new BankAccount();
        $newAccount = $bankAccount::newAccount("Jack", "Gleeson", 2.0);
        $newAccount->setBalance(10);
        $newAccount->payInterest();
        $this->assertEquals(10.2, $newAccount->getBalance());
    }

    // test paying interest 3 times
    public function testPayInterestThreeTimes(): void
    {
        $bankAccount = new BankAccount();
        $newAccount = $bankAccount::newAccount("Jack", "Gleeson", 2.0);
        $newAccount->setBalance(10);
        $newAccount->payInterest();
        $newAccount->payInterest();
        $newAccount->payInterest();
        $this->assertEquals(10.6, round($newAccount->getBalance(), 1));
    }

    //test close account
    public function testCloseAccount(): void
    {
        $bankAccount = new BankAccount();
        $newAccount = $bankAccount::newAccount("Jack", "Gleeson", 2.0);
        $newAccount->closeAccount();
        $this->assertEquals("Closed", $newAccount->getStatus());
        $this->assertEquals(0, $newAccount->getBalance());
    }

    // test change name
    public function testChangeName(): void
    {
        $bankAccount = new BankAccount();
        $newAccount = $bankAccount::newAccount("Jack", "Gleeson", 2.0);
        $newAccount->changeName("John", "Smith");
        $this->assertEquals("John", $newAccount->getFirstName());
        $this->assertEquals("Smith", $newAccount->getSurname());
    }

    // test import account from json file
    public function testImportAccount(): void
    {
        $bankAccount = new BankAccount();
        $json = file_get_contents("tests/test.json");
        $data = json_decode($json, true);
        $newAccount = $bankAccount::importAccount($data);
        $this->assertEquals("Open", $newAccount->getStatus());
        $this->assertEquals(100, $newAccount->getBalance());
        $this->assertEquals(3.0, $newAccount->getInterestRate());
        $this->assertEquals("bob", $newAccount->getFirstName());
        $this->assertEquals("hope", $newAccount->getSurname());
    }


}
