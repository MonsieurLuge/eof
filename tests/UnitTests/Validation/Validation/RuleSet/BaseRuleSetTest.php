<?php

namespace UnitTest\Validation\RuleSet;

use EOF\Validation\Picker\MethodPicker;
use EOF\Validation\Rule\GreaterThan;
use EOF\Validation\Rule\LessThan;
use EOF\Validation\Rule\NotEmpty;
use EOF\Validation\RuleSet\BaseRuleSet;
use EOF\Validation\ValidationResult;
use PHPUnit\Framework\TestCase;

final class BaseRuleSetTest extends TestCase
{

    /** @var BaseRuleSet **/
    private $testSubject;

    public function setUp()
    {
        $this->testSubject = new BaseRuleSet();
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\RuleSet\BaseRuleSet::applyOn
     */
    public function testApplyOnAValidTargetWithNoRule()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $this->testSubject->applyOn(666, 'valid target', $mockedResult);
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\RuleSet\BaseRuleSet::applyOn
     */
    public function testApplyOnAValidTargetWithOneDefaultRule()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $testSubject = new BaseRuleSet([ new GreaterThan(42) ]);

        $testSubject->applyOn(666, 'valid target', $mockedResult);
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\RuleSet\BaseRuleSet::applyOn
     */
    public function testApplyOnAValidTargetWithMoreDefaultRules()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $testSubject = new BaseRuleSet([ new GreaterThan(42), new NotEmpty(), new LessThan(1337) ]);

        $testSubject->applyOn(666, 'valid target', $mockedResult);
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\RuleSet\BaseRuleSet::applyOn
     * @covers EOF\Validation\RuleSet\BaseRuleSet::with
     */
    public function testApplyOnAValidTargetWithMultipleRules()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $this->testSubject
            ->with(new LessThan(1337))
            ->with(new GreaterThan(42))
            ->applyOn(666, 'valid target', $mockedResult);
    }

    /**
     * Two error must be added to the result set.
     * @covers EOF\Validation\RuleSet\BaseRuleSet::applyOn
     * @covers EOF\Validation\RuleSet\BaseRuleSet::with
     */
    public function testApplyOnAnInvalidTargetWithMultipleRules()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->exactly(2))->method('addError');

        $this->testSubject
            ->with(new LessThan(42))      // false
            ->with(new NotEmpty())        // true
            ->with(new GreaterThan(1337)) // false
            ->applyOn(666, 'invalid target', $mockedResult);
    }

    /**
     * "on" must follow at least one rule -> an Exception must be thrown.
     * @covers EOF\Validation\RuleSet\BaseRuleSet::on
     * @expectedException \Exception
     */
    public function testOnWithNoRule()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $this->testSubject
            ->on('value', new MethodPicker('value'))
            ->applyOn(new class() {}, 'no rule', $mockedResult);
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\RuleSet\BaseRuleSet::applyOn
     * @covers EOF\Validation\RuleSet\BaseRuleSet::on
     * @covers EOF\Validation\RuleSet\BaseRuleSet::with
     */
    public function testOnWithAValidTargetAndASingleRule()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $target = new class() {
            public function value() { return 1337; }
        };

        $this->testSubject
            ->with(new GreaterThan(42))
            ->on('value', new MethodPicker('value'))
            ->applyOn($target, 'valid target', $mockedResult);
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\RuleSet\BaseRuleSet::applyOn
     * @covers EOF\Validation\RuleSet\BaseRuleSet::on
     * @covers EOF\Validation\RuleSet\BaseRuleSet::with
     */
    public function testOnWithAValidTargetAndAComplexSetOfRules()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $target = new class() {
            public function value1() { return 666; }
            public function value2() { return 'foo bar'; }
        };

        $this->testSubject
            ->with(new GreaterThan(42))
            ->with(new LessThan(1337))
            ->on('value 1', new MethodPicker('value1'))
            ->with(new NotEmpty())
            ->on('value 2', new MethodPicker('value2'))
            ->with(new GreaterThan(123))
            ->with(new LessThan(1000))
            ->on('value 1', new MethodPicker('value1')) // test this one more time
            ->applyOn($target, 'valid target', $mockedResult);
    }

    /**
     * No error must be added to the result set.
     * @covers EOF\Validation\RuleSet\BaseRuleSet::applyOn
     * @covers EOF\Validation\RuleSet\BaseRuleSet::on
     * @covers EOF\Validation\RuleSet\BaseRuleSet::with
     */
    public function testOnWithAnInvalidTargetAndAComplexSetOfRules()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->exactly(2))->method('addError');

        $target = new class() {
            public function value1() { return 666; }
            public function value2() { return ''; }
        };

        $this->testSubject
            ->with(new GreaterThan(42))
            ->with(new LessThan(123))
            ->on('value 1', new MethodPicker('value1')) // incorrect
            ->with(new NotEmpty())
            ->on('value 2', new MethodPicker('value2')) // incorrect
            ->with(new GreaterThan(123))
            ->with(new LessThan(1000))
            ->on('value 1', new MethodPicker('value1')) // correct
            ->applyOn($target, 'valid target', $mockedResult);
    }

}
