<?php

namespace UnitTests\Validation\Rules;

use EOF\Validation\Rule\GreaterThan;
use EOF\Validation\Rule\MetaRule;
use EOF\Validation\ValidationResult;
use PHPUnit\Framework\TestCase;

final class MetaRuleTest extends TestCase
{

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\Rule\MetaRule::applyOn
     */
    public function testApplyOnAValidSimpleLocation()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $testSubject = new MetaRule(new GreaterThan(123), 'getValue', [ 666 ]);

        $testSubject->applyOn($this->createTargetObject(), 'valid test', $mockedResult);
    }

    /**
     * Creates a dummy object
     * @return object
     */
    private function createTargetObject()
    {
        return new class()
        {
            public function getValue($value) { return $value; }
        };
    }

}
