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

    public function testThisIsATest()
    {
        $ten = Money::Pound(10);
        $this->assertEquals(Money::Pound(20), $ten->times(2));
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
        $bank = new Bank();
        $this->assertEquals(1, $bank->rate("USD", "USD"));
    }

    public function testMixedAddition(): void
    {
        $fiveBucks = Money::Dollar(5);
        $tenFrancs = Money::Franc(10);
        $bank = new Bank();
        $bank->addRate("CHF", "USD", 2);
        $result = $bank->reduce($fiveBucks->plus($tenFrancs), "USD");
        $this->assertEquals(Money::Dollar(10), $result);
    }

    public function testSumPlusMoney(): void
    {
        $fiveBucks = Money::Dollar(5);
        $tenFrancs = Money::Franc(10);
        $bank = new Bank();
        $bank->addRate("CHF", "USD", 2);
        $sum = (new Sum($fiveBucks, $tenFrancs))->plus($fiveBucks);
        $result = $bank->reduce($sum, "USD");
        $this->assertEquals(Money::Dollar(15), $result);
    }

    public function testSumTimes(): void
    {
        $fiveBucks = Money::Dollar(5);
        $tenFrancs = Money::Franc(10);
        $bank = new Bank();
        $bank->addRate("CHF", "USD", 2);
        $sum = (new Sum($fiveBucks, $tenFrancs))->times(2);
        $result = $bank->reduce($sum, "USD");
        $this->assertEquals(Money::Dollar(20), $result);
        
    }

    public function testPlusSameCurrencyReturnsMoney(): void
    {
        $sum = Money::Dollar(1)->plus(Money::Dollar(1));
        $result = $sum->reduce(new Bank(), "USD");
        $this->assertEquals(Money::Dollar(2), $result);
        $this->assertInstanceOf(Money::class, $result);
    }

    public function testBritishPoundMoney(): void
    {
        $fiveQuid = Money::Pound(5);
        $this->assertEquals(5, $fiveQuid->amount);
        $this->assertEquals("GBP", $fiveQuid->currency());
    }

    public function testDollarToBritishPound(): void
    {
        $tenDollars = Money::Dollar(10);
        $bank = new Bank();
        $bank->addRate("USD", "GBP", 2);
        $converted = $bank->reduce($tenDollars, "GBP");
        $this->assertEquals(Money::Pound(5), $converted);
    }

    public function testAdd()
    {
        $money = Money::Dollar(5);
        $result = $money->add(Money::Dollar(5));
        $this->assertEquals(10, $result->amount);
    }
}
