<?php

namespace UnitTests\Picker;

use EOF\Validation\Picker\HashPicker;
use PHPUnit\Framework\TestCase;

final class HashPickerTest extends TestCase
{

    /**
     * @covers EOF\Validator\Picker\HashPicker::valueFrom
     */
    public function testValueFrom_ASimpleArray()
    {
        $testSubject = new HashPicker(1);

        $this->assertSame(
            'bar',
            $testSubject->valueFrom([ 'dummy', 'bar' ])
        );
    }

    /**
     * @covers EOF\Validator\Picker\HashPicker::valueFrom
     */
    public function testValueFrom_AnAssociativeArray()
    {
        $testSubject = new HashPicker('foo');

        $this->assertSame(
            'bar',
            $testSubject->valueFrom([ 'foo' => 'bar' ])
        );
    }

    /**
     * @covers EOF\Validator\Picker\HashPicker::valueFrom
     * @expectedException \Exception
     */
    public function testValueFrom_AnUnknownKey()
    {
        $testSubject = new HashPicker('foo');

        $testSubject->valueFrom([ 'dummy' ]);
    }

}
