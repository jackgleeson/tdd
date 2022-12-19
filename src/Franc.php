<?php

namespace Jack\Tdd;

class Franc
{
    private int $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function times(int $multiplier) : Franc
    {
        return new self($this->amount * $multiplier);
    }

    public function equals(Franc $franc) : bool
    {
        return $franc->amount === $this->amount;
    }

}