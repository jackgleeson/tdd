<?php

namespace Jack\Tdd;

class Bank
{

    public function reduce(Expression $source, string $to) : Money
    {
        $sum = $source;
        return $sum->reduce($to);
    }
}