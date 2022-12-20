<?php

namespace Jack\Tdd;

class Money
{
    protected int $amount;

    public function equals(Money $money) : bool
    {
        $amountMatches = $money->amount === $this->amount;
        $typeMatches = get_class($this) === get_class($money);
        return $amountMatches && $typeMatches;
    }
}