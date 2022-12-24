<?php

namespace Jack\Tdd;

class Bank
{

    public function reduce(Expression $source, string $to) : Money
    {
        return $source->reduce($this, $to);
    }

    public function rate(string $from, string $to): int
    {
        return $from == "CHF" && $to == "USD" ? 2 : 1;
    }
}