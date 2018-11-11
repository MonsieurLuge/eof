<?php

namespace UnitTests\Picker;

use EOF\Validation\Picker\HashPicker;
use EOF\Validation\Picker\NestedPicker;
use EOF\Validation\Picker\PropertyPicker;
use PHPUnit\Framework\TestCase;

final class NestedPickerTest extends TestCase
{

    /**
     * @covers EOF\Validator\Picker\NestedPicker::valueFrom
     */
    public function testValueFrom()
    {
        $target = new class() { public $foo = [ 'bar' => 'baz' ]; };

        $testSubject = new NestedPicker([
            new PropertyPicker('foo'), // the first value to fetch -> [ 'bar' => 'baz' ]
            new HashPicker('bar')      // the value to fetch from the previous value -> 'baz'
        ]);

        $this->assertSame(
            'baz',
            $testSubject->valueFrom($target)
        );
    }

    /**
     * @covers EOF\Validator\Picker\NestedPicker::valueFrom
     * @expectedException \Exception
     */
    public function testValueFrom_ABadTarget()
    {
        $target = new class() {};

        $testSubject = new NestedPicker([
            new PropertyPicker('foo'),
            new HashPicker('bar')
        ]);

        $testSubject->valueFrom($target);
    }

}
