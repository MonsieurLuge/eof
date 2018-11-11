<?php

namespace UnitTest\Validation\Rule;

use EOF\Validation\Rule\Matches;
use EOF\Validation\ValidationResult;
use PHPUnit\Framework\TestCase;

final class MatchesTest extends TestCase
{

    /** @var Matches **/
    private $testSubject;

    public function setUp()
    {
        $this->testSubject = new Matches('^\/[a-z]+\/[0-9]+\/[a-z]+$');
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\Rule\Matches::applyOn
     */
    public function testApplyOnARightPattenr()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $this->testSubject->applyOn('/foo/1234/bar', 'valid', $mockedResult);
    }

    /**
     * One error must be added to the result set.
     * @covers EOF\Validation\Rule\Matches::applyOn
     */
    public function testApplyOnAWrongValue()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $this->testSubject->applyOn('/FOO/1234/BAR', 'uppercase', $mockedResult);
    }

    /**
     * One error must be added to the result set.
     * @covers EOF\Validation\Rule\Matches::applyOn
     */
    public function testApplyOnAWrongValue2()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $this->testSubject->applyOn('uK1BpxsoIr', 'random string', $mockedResult);
    }

}
