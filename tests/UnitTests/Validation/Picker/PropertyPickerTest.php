<?php

namespace UnitTests\Picker;

use EOF\Validation\Picker\PropertyPicker;
use PHPUnit\Framework\TestCase;

final class PropertyPickerTest extends TestCase
{

    /** @var PropertyPicker **/
    private $testSubject;

    public function setUp()
    {
        $this->testSubject = new PropertyPicker('foo');
    }

    /**
     * @covers EOF\Validator\Picker\PropertyPicker::valueFrom
     */
    public function testValueFrom()
    {
        $target = new class() { public $foo = 'bar'; };

        $this->assertEquals(
            'bar',
            $this->testSubject->valueFrom($target)
        );
    }

    /**
     * @covers EOF\Validator\Picker\PropertyPicker::valueFrom
     * @expectedException \Exception
     */
    public function testValueFrom_AnUnknownProperty()
    {
        $target = new class() {};

        $this->testSubject->valueFrom($target);
    }

}
