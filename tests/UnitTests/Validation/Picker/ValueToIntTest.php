<?php

namespace UnitTests\Picker;

use EOF\Validation\Picker\FakePicker;
use EOF\Validation\Picker\ValueToInt;
use PHPUnit\Framework\TestCase;

final class ValueToIntTest extends TestCase
{

    /**
     * @covers EOF\Validator\Picker\ValueToInt::valueFrom
     */
    public function testValueFrom_AFloatTarget()
    {
        $testSubject = new ValueToInt(new FakePicker(1337.42));

        $this->assertSame(
            1337,
            $testSubject->valueFrom('see the FakePicker returned value')
        );
    }

    /**
     * @covers EOF\Validator\Picker\ValueToInt::valueFrom
     */
    public function testValueFrom_AStringTarget()
    {
        $testSubject = new ValueToInt(new FakePicker('1337.42'));

        $this->assertSame(
            1337,
            $testSubject->valueFrom('see the FakePicker returned value')
        );
    }

}
