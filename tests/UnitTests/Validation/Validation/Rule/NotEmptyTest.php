<?php

namespace UnitTest\Validation\Rule;

use EOF\Validation\Rule\NotEmpty;
use EOF\Validation\ValidationResult;
use PHPUnit\Framework\TestCase;

final class NotEmptyTest extends TestCase
{

    /** @var NotEmpty **/
    private $testSubject;

    public function setUp()
    {
        $this->testSubject = new NotEmpty();
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\Rule\NotEmpty::applyOn
     */
    public function testApplyOnARightValue()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $this->testSubject->applyOn('1234', 'test', $mockedResult);
    }

    /**
     * One error must be added to the result set.
     * @covers EOF\Validation\Rule\NotEmpty::applyOn
     */
    public function testApplyOnAnEmptyString()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $this->testSubject->applyOn('', 'string', $mockedResult);
    }

    /**
     * One error must be added to the result set.
     * @covers EOF\Validation\Rule\NotEmpty::applyOn
     */
    public function testApplyOnAnEmptyArray()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $this->testSubject->applyOn([], 'array', $mockedResult);
    }

}
