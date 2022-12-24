<?php

namespace Jack\Tdd;

class Sum implements Expression
{

    public Expression $augend;

    public Expression $addend;

    public function __construct(Expression $augend, Expression $added)
    {
        $this->augend = $augend;
        $this->addend = $added;
    }

    public function convert(Bank $bank, string $to) : Money
    {
        $augend_reduce = $this->augend->convert($bank, $to)->amount;
        $addend_reduce = $this->addend->convert($bank, $to)->amount;
        $amount = $augend_reduce + $addend_reduce;
        return new Money($amount, $to);
    }


    public function plus(Expression $addend): Sum
    {
       return new self($this, $addend);
    }

    public function times(int $multiplier): Expression
    {
        $augend_times = $this->augend->times($multiplier);
        $addend_times = $this->addend->times($multiplier);
        return new self($augend_times, $addend_times);
    }
}