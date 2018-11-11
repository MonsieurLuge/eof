<?php

namespace UnitTests\Validation\Picker;

use EOF\Validation\Picker\FakePicker;
use PHPUnit\Framework\TestCase;

final class FakePickerTest extends TestCase
{

    /**
     * @covers EOF\Validator\Picker\FakePicker::valueFrom
     */
    public function testValueFrom()
    {
        $testSubject = new FakePicker(1234);

        $this->assertSame(
            1234,
            $testSubject->valueFrom([ 1337.42 ])
        );
    }

}
