<?php

namespace UnitTest\Validation\Rule;

use EOF\Validation\Rule\LessThan;
use EOF\Validation\ValidationResult;
use PHPUnit\Framework\TestCase;

final class LessThanTest extends TestCase
{

    /** @var LessThan **/
    private $testSubject;

    public function setUp()
    {
        $this->testSubject = new LessThan(666);
    }

    /**
     * No error must be added to the result set when the tested value is strictly
     * inferior to the defined one.
     * @covers EOF\Validation\Rule\LessThan::applyOn
     */
    public function testApplyOnARightValue()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $this->testSubject->applyOn(42, 'valid', $mockedResult);
    }

    /**
     * One error must be added to the result set when the tested value is strictly
     * identical to the defined one.
     * @covers EOF\Validation\Rule\LessThan::applyOn
     */
    public function testApplyOnAStrictlyIdenticalValue()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $this->testSubject->applyOn(666, 'wrong because of strictly identical', $mockedResult);
    }

    /**
     * One error must be added to the result set.
     * @covers EOF\Validation\Rule\LessThan::applyOn
     */
    public function testApplyOnALowerValue()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $this->testSubject->applyOn(1337, 'greater value', $mockedResult);
    }

}
