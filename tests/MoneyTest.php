<?php

use Jack\Tdd\Bank;
use Jack\Tdd\Money;
use Jack\Tdd\Sum;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{

    public function testMultiplication() : void
    {
        $five = Money::Dollar(5);
        $this->assertEquals(Money::Dollar(10), $five->times(2));
        $this->assertEquals(Money::Dollar(15), $five->times(3));
    }

    public function testEquality() : void
    {
        $this->assertTrue(Money::Dollar(5)->equals(Money::Dollar(5)));
        $this->assertFalse(Money::Dollar(5)->equals(Money::Dollar(6)));
        $this->assertTrue(Money::Franc(5)->equals(Money::Franc(5)));
    }

    public function testCurrency() : void
    {
        $this->assertEquals("USD", Money::Dollar(1)->currency());
        $this->assertEquals("CHF", Money::Franc(1)->currency());
    }

    public function testSimpleAddition() : void
    {
        $five = Money::Dollar(5);
        $sum = $five->plus($five);
        $bank = new Bank();
        $reduced = $bank->reduce($sum, "USD");
        $this->assertEquals(Money::Dollar(10), $reduced);
    }

    public function testPlusReturnsSum() : void
    {
        $five = Money::Dollar(5);
        $result = $five->plus($five);
        $sum = $result;
        $this->assertEquals($five, $sum->augend);
        $this->assertEquals($five, $sum->addend);
    }

    public function testReduceSum() : void
    {
        $sum = new Sum(Money::Dollar(3), Money::Dollar(4));
        $bank = new Bank();
        $result = $bank->reduce($sum, "USD");
        $this->assertEquals(Money::Dollar(7), $result);
    }

    public function testReduceMoney(): void
    {
        $bank = new Bank();
        $result = $bank->reduce(Money::Dollar(1), "USD");
        $this->assertEquals(Money::Dollar(1), $result);
    }

    public function testReduceMoneyDifferentCurrency(): void
    {
        $bank = new Bank();
        $bank->addRate("CHF", "USD", 2);
        $result = $bank->reduce(Money::Franc(2), "USD");
        $this->assertEquals(Money::Dollar(1), $result);
    }

    public function testArrayEquals(): void
    {
        // this doesn't work in java apparently
        $this->assertEquals((object) ['abc'], (object) ['abc']);
    }

    public function testIdentityRate(): void
    {
        $this->assertEquals(1, (new Bank())->rate("USD", "USD"));
    }
}
