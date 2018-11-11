<?php

namespace UnitTest\Validation\RuleSet;

use EOF\Validation\Picker\MethodPicker;
use EOF\Validation\Rule\TypeOf;
use EOF\Validation\Rule\GreaterThan;
use EOF\Validation\RuleSet\BaseRuleSet;
use EOF\Validation\RuleSet\NestedRuleSet;
use EOF\Validation\RuleSet\RuleSetWithLocation;
use EOF\Validation\ValidationResult;
use PHPUnit\Framework\TestCase;

final class NestedRuleSetTest extends TestCase
{

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\RuleSet\NestedRuleSet::applyOn
     */
    public function testApplyOn_ATarget_WithoutRuleSets()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $testSubject = new NestedRuleSet();

        $testSubject->applyOn(new class() {}, 'dummy target', $mockedResult);
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\RuleSet\NestedRuleSet::applyOn
     */
    public function testApplyOn_AValidTarget_WithDefaultRuleSets()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $defaultRuleSet1 = new BaseRuleSet([ new GreaterThan(123) ]);
        $defaultRuleSet2 = new BaseRuleSet([ new GreaterThan(666) ]);

        $testSubject = new NestedRuleSet([ $defaultRuleSet1, $defaultRuleSet2 ]);

        $testSubject->applyOn(1337, 'valid target', $mockedResult);
    }

    /**
     * One error must be added to the result set.
     * @covers EOF\Validation\RuleSet\NestedRuleSet::applyOn
     */
    public function testApplyOn_AnInvalidTarget_WithDefaultRuleSets()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $defaultRuleSet1 = new BaseRuleSet([ new GreaterThan(123) ]);
        $defaultRuleSet2 = new BaseRuleSet([ new GreaterThan(1337) ]);

        $testSubject = new NestedRuleSet([ $defaultRuleSet1, $defaultRuleSet2 ]);

        $testSubject->applyOn(666, 'invalid target', $mockedResult);
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\RuleSet\NestedRuleSet::applyOn
     * @covers EOF\Validation\RuleSet\NestedRuleSet::on
     */
    public function testApplyOn_AnValidTarget_WithAnOtherLocationAndNoNewRule()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $defaultRuleSet = new RuleSetWithLocation('value 1', [ new GreaterThan(42) ], new MethodPicker('value1'));

        $target = new class() {
            public function value1() { return 666; }
            public function value2() { return 1337; }
        };

        $testSubject = new NestedRuleSet([ $defaultRuleSet ]);

        $testSubject
            ->on('value 2', new MethodPicker('value2'))
            ->applyOn($target, 'valid target', $mockedResult);
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\RuleSet\NestedRuleSet::applyOn
     * @covers EOF\Validation\RuleSet\NestedRuleSet::on
     * @covers EOF\Validation\RuleSet\NestedRuleSet::with
     */
    public function testApplyOn_AnValidTarget_WithAnOtherLocationAndAnotherRule()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $defaultRuleSet = new RuleSetWithLocation('value 1', [ new GreaterThan(42) ], new MethodPicker('value1'));

        $target = new class() {
            public function value1() { return 666; }
            public function value2() { return 1337; }
        };

        $testSubject = new NestedRuleSet([ $defaultRuleSet ]);

        $testSubject
            ->with(new GreaterThan(666))
            ->on('value 2', new MethodPicker('value2'))
            ->applyOn($target, 'valid target', $mockedResult);
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\RuleSet\NestedRuleSet::applyOn
     * @covers EOF\Validation\RuleSet\NestedRuleSet::with
     */
    public function testApplyOn_AnValidTarget_WithAnotherRule()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $defaultRuleSet = new RuleSetWithLocation('value 1', [ new GreaterThan(42) ], new MethodPicker('value1'));

        $target = new class() {
            public function value1() { return 666; }
            public function value2() { return 1337; }
        };

        $testSubject = new NestedRuleSet([ $defaultRuleSet ]);

        $testSubject
            ->with(new TypeOf('object'))
            ->applyOn($target, 'valid target', $mockedResult);
    }

    /**
     * One error must be added to the result set.
     * @covers EOF\Validation\RuleSet\NestedRuleSet::applyOn
     * @covers EOF\Validation\RuleSet\NestedRuleSet::on
     * @covers EOF\Validation\RuleSet\NestedRuleSet::with
     */
    public function testApplyOn_AnInvalidTarget_WithAnOtherLocationAndAnotherRule()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $defaultRuleSet = new RuleSetWithLocation('value 1', [ new GreaterThan(1337) ], new MethodPicker('value1'));

        $target = new class() {
            public function value1() { return 666; }
            public function value2() { return 1337; }
        };

        $testSubject = new NestedRuleSet([ $defaultRuleSet ]);

        $testSubject
            ->with(new GreaterThan(666))
            ->on('value 2', new MethodPicker('value2'))
            ->applyOn($target, 'valid target', $mockedResult);
    }

}
