<?php

namespace Jack\Tdd;

interface Expression
{
    public function reduce(Bank $bank, string $to);

}