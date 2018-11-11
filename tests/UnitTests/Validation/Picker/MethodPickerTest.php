<?php

namespace UnitTests\Picker;

use PHPUnit\Framework\TestCase;

use EOF\Validation\Picker\MethodPicker;

final class MethodPickerTest extends TestCase
{

    /**
     * @covers EOF\Validator\Picker\MethodPicker::valueFrom
     */
    public function testValueFrom_WithoutConstructParameters()
    {
        $target = new class() { public function foo() { return 'bar'; } };

        $testSubject = new MethodPicker('foo');

        $this->assertSame(
            'bar',
            $testSubject->valueFrom($target)
        );
    }

    /**
     * @covers EOF\Validator\Picker\MethodPicker::valueFrom
     */
    public function testValueFrom_WithConstructParameters()
    {
        $target = new class() {
            // Returns $str1 concatenated with $str2
            public function foo($str1, $str2) { return $str1 . $str2; }
        };

        $testSubject = new MethodPicker('foo', [ 'bar', 'baz' ]);

        $this->assertSame(
            'barbaz',
            $testSubject->valueFrom($target)
        );
    }

    /**
     * @covers EOF\Validator\Picker\MethodPicker::valueFrom
     * @expectedException \Exception
     */
    public function testValueFrom_AnUnknownMethod()
    {
        $target = new class() {};

        $testSubject = new MethodPicker('foo');

        $testSubject->valueFrom($target);
    }

}
