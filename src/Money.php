<?php

namespace Jack\Tdd;

class Money implements Expression
{

    public int $amount;

    protected string $currency;

    public function __construct(int $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }



    public function currency(): string
    {
        return $this->currency;
    }

    public function add(Money $addend): Money
    {
        return new self($this->amount + $addend->amount, $this->currency());
    }

    public function equals(Money $money): bool
    {
        $amountMatches = $money->amount === $this->amount;
        $currencyMatches = $this->currency() === $money->currency();
        return $amountMatches && $currencyMatches;
    }

    public static function Dollar(int $amount): Money
    {
        return new self($amount, "USD");
    }

    public static function Franc(int $amount): Money
    {
        return new self($amount, "CHF");
    }

    public static function Pound(int $amount): Money
    {
        return new self($amount, "GBP");
    }

    public function times(int $multiplier): Expression
    {
        return new self($this->amount * $multiplier, $this->currency());
    }

    public function plus(Expression $addend): Expression
    {
        return new Sum($this, $addend);
    }

    public function reduce(Bank $bank, string $to): Money
    {
        $rate = $bank->rate($this->currency(), $to);
        return new Money($this->amount / $rate, $to);
    }

}