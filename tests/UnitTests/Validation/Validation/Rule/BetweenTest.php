<?php

namespace UnitTest\Validation\Rule;

use EOF\Validation\Rule\Between;
use EOF\Validation\ValidationResult;
use PHPUnit\Framework\TestCase;

final class BetweenTest extends TestCase
{

    /** @var Between **/
    private $testSubject;

    public function setUp()
    {
        $this->testSubject = new Between(-42, 1337);
    }

    /**
     * The "upper" boundary must be strictly greater than the "lower" one
     * @covers EOF\Validation\Rule\Between::__construct
     * @expectedException \InvalidArgumentException
     */
    public function testConstruct_WithInvertedBoundaries()
    {
        $testSubject = new Between(1337, 42);
    }

    /**
     * The "upper" boundary must be strictly greater than the "lower" one
     * @covers EOF\Validation\Rule\Between::__construct
     * @expectedException \InvalidArgumentException
     */
    public function testConstruct_WithSimilarBoundaries()
    {
        $testSubject = new Between(42, 42);
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\Rule\Between::__construct
     * @covers EOF\Validation\Rule\Between::applyOn
     */
    public function testBetween_WithAValidValue()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $this->testSubject->applyOn(666, 'valid', $mockedResult);
    }

    /**
     * The boundary values are allowed.
     * @covers EOF\Validation\Rule\Between::__construct
     * @covers EOF\Validation\Rule\Between::applyOn
     */
    public function testBetween_WithTheLowerBoundaryValue()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $this->testSubject->applyOn(-42, 'valid', $mockedResult);
    }

    /**
     * The boundary values are allowed.
     * @covers EOF\Validation\Rule\Between::__construct
     * @covers EOF\Validation\Rule\Between::applyOn
     */
    public function testBetween_WithTheUpperBoundaryValue()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $this->testSubject->applyOn(1337, 'valid', $mockedResult);
    }

    /**
     * One error must be added to the result set.
     * @covers EOF\Validation\Rule\Between::__construct
     * @covers EOF\Validation\Rule\Between::applyOn
     */
    public function testBetween_WithAValueOutOfBound()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $this->testSubject->applyOn(2000, 'invalid', $mockedResult);
    }

}
