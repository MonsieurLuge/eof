<?php

namespace UnitTest\Validation\Rule;

use EOF\Validation\Rule\GreaterThan;
use EOF\Validation\ValidationResult;
use PHPUnit\Framework\TestCase;

final class GreaterThanTest extends TestCase
{

    /** @var GreaterThan **/
    private $testSubject;

    public function setUp()
    {
        $this->testSubject = new GreaterThan(42);
    }

    /**
     * No error must be added to the result set when the tested value is strictly
     * superior to the defined one.
     * @covers EOF\Validation\Rule\GreaterThan::applyOn
     */
    public function testApplyOnARightValue()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $this->testSubject->applyOn(666, 'valid', $mockedResult);
    }

    /**
     * One error must be added to the result set when the tested value is strictly
     * identical to the defined one.
     * @covers EOF\Validation\Rule\GreaterThan::applyOn
     */
    public function testApplyOnAStrictlyIdenticalValue()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $this->testSubject->applyOn(42, 'wrong because of strictly identical', $mockedResult);
    }

    /**
     * One error must be added to the result set.
     * @covers EOF\Validation\Rule\GreaterThan::applyOn
     */
    public function testApplyOnALowerValue()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $this->testSubject->applyOn(13, 'lower value', $mockedResult);
    }

}
