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

    public function currency() : string
    {
        return $this->currency;
    }

    public function equals(Money $money) : bool
    {
        $amountMatches = $money->amount === $this->amount;
        $currencyMatches = $this->currency() === $money->currency();
        return $amountMatches && $currencyMatches;
    }

    public static function Dollar(int $amount) : Money
    {
        return new self($amount, "USD");
    }

    public static function Franc(int $amount) : Money
    {
        return new self($amount, "CHF");
    }

    public function times(int $multiplier) : Money
    {
        return new self($this->amount * $multiplier, $this->currency());
    }

    public function plus(Money $addend) : Sum
    {
        return new Sum($this, $addend);
    }

}