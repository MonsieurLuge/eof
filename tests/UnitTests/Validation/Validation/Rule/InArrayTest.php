<?php

namespace UnitTest\Validation\Rule;

use EOF\Validation\Rule\InArray;
use EOF\Validation\ValidationResult;
use PHPUnit\Framework\TestCase;

final class InArrayTest extends TestCase
{

    /** @var InArray **/
    private $testSubject;

    public function setUp()
    {
        $this->testSubject = new InArray([
            1234,
            'foo' => 'bar',
            'ok ok'
        ]);
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\Rule\InArray::applyOn
     */
    public function testApplyOnARightValue()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $this->testSubject
            ->applyOn('ok ok', 'valid 1', $mockedResult)
            ->applyOn(1234, 'valid 2', $mockedResult)
            ->applyOn('bar', 'valid 3', $mockedResult);
    }

    /**
     * One error must be added to the result set.
     * @covers EOF\Validation\Rule\InArray::applyOn
     */
    public function testApplyOnAUnknownValue()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $this->testSubject->applyOn('1234', 'unknown', $mockedResult);
    }

}
