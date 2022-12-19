<?php

namespace Jack\Tdd;

class Dollar
{
    private int $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function times(int $multiplier) : Dollar
    {
        return new self($this->amount * $multiplier);
    }

    public function equals(Dollar $dollar) : bool
    {
        return $dollar->amount === $this->amount;
    }

}