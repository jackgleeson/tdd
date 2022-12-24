<?php

namespace Jack\Tdd;

interface Expression
{
    public function convert(Bank $bank, string $to);
    public function plus(Expression $addend);
    public function times(int $multiplier);

}