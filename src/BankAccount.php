<?php

namespace Jack\Tdd;

class BankAccount
{

    private string $status;
    private string $first_name;
    private string $surname;
    private float $interest_rate;

    private float $balance = 0;

    /**
     * @param string $first_name
     * @param string $surname
     * @param float $interest_rate
     * @return BankAccount
     */
    public static function newAccount(string $first_name, string $surname, float $interest_rate): BankAccount
    {
        $account = new self();
        $account->status = "Open";
        $account->first_name = $first_name;
        $account->surname = $surname;
        $account->interest_rate = $interest_rate;
        return $account;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return float
     */
    public function getInterestRate(): float
    {
        return $this->interest_rate;
    }

    public function setBalance(int $int): void
    {
        $this->balance = $int;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function reduceBalance(float $float): void
    {
        $this->balance -= $float;
    }


    public function payInterest(): void
    {
        $this->balance += $this->balance * ($this->interest_rate/100);
    }

    /**
     * @param float $rate
     */
    public function setInterestRate(float $rate): void
    {
        $this->interest_rate = $rate;
    }

    public function closeAccount(): void
    {
        $this->status = "Closed";
        $this->balance = 0;
    }

    public function changeName(string $firstName, string $lastName) : void
    {
        $this->first_name = $firstName;
        $this->surname = $lastName;
    }

    // import bank account from json file
    public static function importAccount(array $data): BankAccount
    {
        $account = new self();
        $account->status = "Open";
        $account->first_name = $data["first_name"];
        $account->surname = $data["surname"];
        $account->interest_rate = $data["interest_rate"];
        $account->balance = $data["balance"];
        return $account;
    }



}