<?php

namespace UnitTest\Validation\Rule;

use EOF\Validation\ValidationResult;

use PHPUnit\Framework\TestCase;

use EOF\Validation\Rule\TypeOf;

final class TypeOfTest extends TestCase
{

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\Rule\TypeOf::applyOn
     */
    public function testApplyOn_ARightTarget()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $testSubject = new TypeOf('array');

        $testSubject->applyOn([ 1, 2 ], 'valid', $mockedResult);
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\Rule\TypeOf::applyOn
     */
    public function testApplyOn_AnObjectTarget()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $testSubject = new TypeOf('object');

        $testSubject->applyOn(new TypeOf('foo'), 'valid', $mockedResult);
    }

    /**
     * An error must be added to the result set.
     * @covers EOF\Validation\Rule\TypeOf::applyOn
     */
    public function testApplyOn_AnInvalidTarget()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $testSubject = new TypeOf('array');

        $testSubject->applyOn(1234, 'invalid', $mockedResult);
    }

}
