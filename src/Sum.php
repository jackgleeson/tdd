<?php

namespace Jack\Tdd;

class Sum implements Expression
{

    public Money $augend;

    public Money $addend;

    /**
     * Sum constructor.
     *
     * @param \Jack\Tdd\Money $augend
     * @param \Jack\Tdd\Money $added
     */
    public function __construct(Money $augend, Money $added)
    {
        $this->augend = $augend;
        $this->addend = $added;
    }

    public function reduce(Bank $bank, string $to) : Money
    {
        $amount = $this->augend->amount + $this->addend->amount;
        return new Money($amount, $to);
    }


}