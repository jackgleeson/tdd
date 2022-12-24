<?php

namespace Jack\Tdd;

class Pair
{
    private string $from;
    private string $to;

    public function __construct(string $from, string $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function equals(Pair $pair): bool
    {
        return $this->from === $pair->from && $this->to === $pair->to;
    }

    public function hashCode(): int
    {
        return 0;
    }

}