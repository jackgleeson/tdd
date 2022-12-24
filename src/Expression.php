<?php

namespace Jack\Tdd;

interface Expression
{
    public function reduce(Bank $bank, string $to);
    public function plus(Expression $addend);
    public function times(int $multiplier);

}