<?php
declare(strict_types = 1);

namespace App\Tests\Money;

use App\Money\Dollar;
use App\Money\Franc;
use App\Money\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testMultiplication(): void
    {
        $five = Money::dollar(5);
        $this->assertEquals(Money::dollar(10), $five->times(2));
        $this->assertEquals(Money::dollar(15), $five->times(3));
    }

    public function testEquality(): void
    {
        $this->assertTrue((Money::dollar(5))->equals(Money::dollar(5)));
        $this->assertFalse((Money::dollar(5))->equals(Money::dollar(6)));
        $this->assertTrue((Money::franc(5))->equals(Money::franc(5)));
        $this->assertFalse((Money::franc(5))->equals(Money::franc(6)));

        $this->assertFalse((Money::dollar(5))->equals(Money::franc(5)));
    }

    public function testDifferentClassEquality()
    {
        $this->assertTrue(Money::franc(5)->equals(new Money(5, 'CHF')));
        $this->assertTrue(Money::dollar(5)->equals(new Money(5, 'USD')));
    }

    public function testFrancMultiplication(): void
    {
        $five = Money::franc(5);
        $this->assertEquals(Money::franc(10), $five->times(2));
        $this->assertEquals(Money::franc(15), $five->times(3));
    }

    public function testCurrency(): void
    {
        $this->assertSame('USD', Money::dollar(1)->currency());
        $this->assertSame('CHF', Money::franc(1)->currency());
    }
}
