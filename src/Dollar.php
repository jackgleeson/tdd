<?php

namespace Jack\Tdd;

class Dollar
{
    public int $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function times(int $multiplier) : Dollar
    {
        return new self($this->amount * $multiplier);
    }

    public function equals(object $object) : bool
    {
        $dollar = $object;
        return $dollar->amount == $this->amount;
    }

}