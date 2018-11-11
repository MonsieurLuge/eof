<?php

namespace UnitTest\Validation\Rule;

use EOF\Validation\Rule\MaxLength;
use EOF\Validation\ValidationResult;
use PHPUnit\Framework\TestCase;

final class MaxLengthTest extends TestCase
{

    /**
     * It is not allowed to create a "0 max length"
     * @expectedException \InvalidArgumentException
     */
    public function testConstruct_WithZero()
    {
        $testSubject = new MaxLength(0);
    }

    /**
     * It is not allowed to create a "negative max length"
     * @expectedException \InvalidArgumentException
     */
    public function testConstruct_WithANegativeValue()
    {
        $testSubject = new MaxLength(-42);
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\Rule\MaxLength::__construct
     * @covers EOF\Validation\Rule\MaxLength::applyOn
     */
    public function testApplyOn_AValidString()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $testSubject = new MaxLength(10);

        $testSubject->applyOn('/foo/1234/', '10 characters string', $mockedResult);
    }

    /**
     * One error must be added to the result set.
     * @covers EOF\Validation\Rule\MaxLength::__construct
     * @covers EOF\Validation\Rule\MaxLength::applyOn
     */
    public function testApplyOn_ATooLongString()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $testSubject = new MaxLength(10);

        $testSubject->applyOn('/foo/12345/', '11 characters string', $mockedResult);
    }

}
