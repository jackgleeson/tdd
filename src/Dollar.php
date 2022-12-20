<?php

namespace Jack\Tdd;

class Dollar extends Money
{

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function times(int $multiplier) : Dollar
    {
        return new self($this->amount * $multiplier);
    }
}