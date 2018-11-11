<?php

namespace UnitTest\Validation\Rule;

use EOF\Validation\Rule\Uppercase;
use EOF\Validation\ValidationResult;
use PHPUnit\Framework\TestCase;

final class UppercaseTest extends TestCase
{

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\Rule\Uppercase::applyOn
     */
    public function testApplyOn_AValidTarget()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $testSubject = new Uppercase();

        $testSubject->applyOn('FOO 123, B@R', 'valid', $mockedResult);
    }

    /**
     * One error must be added to the result set.
     * @covers EOF\Validation\Rule\Uppercase::applyOn
     */
    public function testApplyOn_AnInvalidTarget()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $testSubject = new Uppercase();

        $testSubject->applyOn('foO 123, b@r', 'valid', $mockedResult);
    }

}
