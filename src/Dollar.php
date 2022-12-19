<?php

namespace Jack\Tdd;

class Dollar
{
    public int $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function times(int $multiplier) : void
    {
        $this->amount *= $multiplier;
    }

}