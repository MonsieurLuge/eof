<?php

namespace UnitTests\Validation\RuleSet;

use EOF\Validation\Picker\FakePicker;
use EOF\Validation\Picker\HashPicker;
use EOF\Validation\Picker\PropertyPicker;
use EOF\Validation\Rule\LessThan;
use EOF\Validation\Rule\GreaterThan;
use EOF\Validation\RuleSet\RuleSetWithLocation;
use EOF\Validation\ValidationResult;
use PHPUnit\Framework\TestCase;

final class RuleSetWithLocationTest extends TestCase
{

    /**
     * @covers EOF\Validation\RuleSet\RuleSetWithLocation::applyOn
     */
    public function testApplyOn_WithoutDefaultRule()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $target = new class() { public $foo = 666; };

        $testSubject = new RuleSetWithLocation('test ok', [], new PropertyPicker('foo'));

        // no rule -> no error must be added to the result set
        $testSubject->applyOn($target, 'foo property', $mockedResult);
    }

    /**
     * @covers EOF\Validation\RuleSet\RuleSetWithLocation::applyOn
     */
    public function testApplyOn_WithDefaultRules()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $target = new class() { public $foo = 666; };
        $rule1  = new GreaterThan(42); // true
        $rule2  = new LessThan(1337); // true

        $testSubject = new RuleSetWithLocation('test ok', [ $rule1, $rule2 ], new PropertyPicker('foo'));

        // no error must be added to the result set
        $testSubject->applyOn($target, 'foo property', $mockedResult);
    }

    /**
     * @covers EOF\Validation\RuleSet\RuleSetWithLocation::applyOn
     */
    public function testApplyOn_WithDefaultRules_AndOneError()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $target = new class() { public $foo = 666; };
        $rule1  = new GreaterThan(42); // true
        $rule2  = new GreaterThan(1337); // false

        $testSubject = new RuleSetWithLocation('test with error', [ $rule1, $rule2 ], new PropertyPicker('foo'));

        // one error must be added to the result set
        $testSubject->applyOn($target, 'foo property', $mockedResult);
    }

    /**
     * It makes no sense to call the "on" method
     * @covers EOF\Validation\RuleSet\RuleSetWithLocation::on
     * @expectedException \Exception
     */
    public function testOn_AlwaysThrowsAnException()
    {
        $testSubject = new RuleSetWithLocation('test', [], new FakePicker('nope'));

        $testSubject->on('exception', new FakePicker('always nope'));
    }

    /**
     * @covers EOF\Validation\RuleSet\RuleSetWithLocation::on
     * @covers EOF\Validation\RuleSet\RuleSetWithLocation::with
     */
    public function testWith_WithoutDefaultRule()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $target = [ 'foo' => 666, 'bar' => 123 ];
        $rule   = new GreaterThan(42); // true

        $testSubject = new RuleSetWithLocation('test ok', [], new HashPicker('foo'));

        // no error must be added to the result set
        $testSubject
            ->with($rule)
            ->on('bar value', new HashPicker('bar'))
            ->applyOn($target, 'valid hash', $mockedResult);
    }

    /**
     * @covers EOF\Validation\RuleSet\RuleSetWithLocation::on
     * @covers EOF\Validation\RuleSet\RuleSetWithLocation::with
     */
    public function testWith_OneDefaultRule()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->never())->method('addError');

        $target = [ 'foo' => 666, 'bar' => 123 ];
        $rule1  = new GreaterThan(42); // true, applied on "foo"
        $rule2  = new GreaterThan(42); // true, applied on "bar"

        $testSubject = new RuleSetWithLocation('test ok', [ $rule1 ], new HashPicker('foo'));

        // no error must be added to the result set
        $testSubject
            ->with($rule2)
            ->on('bar value', new HashPicker('bar'))
            ->applyOn($target, 'valid hash', $mockedResult);
    }

    /**
     * @covers EOF\Validation\RuleSet\RuleSetWithLocation::on
     * @covers EOF\Validation\RuleSet\RuleSetWithLocation::with
     */
    public function testWith_OneDefaultRule_AndOneError()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $target = [ 'foo' => 666, 'bar' => 123 ];
        $rule1  = new GreaterThan(1337); // false, applied on "foo"
        $rule2  = new GreaterThan(42); // true, applied on "bar"

        $testSubject = new RuleSetWithLocation('test ok', [ $rule1 ], new HashPicker('foo'));

        // one error must be added to the result set
        $testSubject
            ->with($rule2)
            ->on('bar value', new HashPicker('bar'))
            ->applyOn($target, 'valid hash', $mockedResult);
    }

    /**
     * @covers EOF\Validation\RuleSet\RuleSetWithLocation::on
     * @covers EOF\Validation\RuleSet\RuleSetWithLocation::with
     */
    public function testWith_OneDefaultRule_AndAnotherError()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->once())->method('addError');

        $target = [ 'foo' => 666, 'bar' => 123 ];
        $rule1  = new GreaterThan(42); // true, applied on "foo"
        $rule2  = new GreaterThan(1337); // false, applied on "bar"

        $testSubject = new RuleSetWithLocation('test ok', [ $rule1 ], new HashPicker('foo'));

        // one error must be added to the result set
        $testSubject
            ->with($rule2)
            ->on('bar value', new HashPicker('bar'))
            ->applyOn($target, 'valid hash', $mockedResult);
    }

    /**
     * @covers EOF\Validation\RuleSet\RuleSetWithLocation::on
     * @covers EOF\Validation\RuleSet\RuleSetWithLocation::with
     */
    public function testWith_OneDefaultRule_AndTwoErrors()
    {
        $mockedResult = $this->createMock(ValidationResult::class);
        $mockedResult->expects($this->exactly(2))->method('addError');

        $target = [ 'foo' => 666, 'bar' => 123 ];
        $rule   = new GreaterThan(1337); // false, applied on "foo" and "bar"

        $testSubject = new RuleSetWithLocation('test ok', [ $rule ], new HashPicker('foo'));

        // two error must be added to the result set
        $testSubject
            ->with($rule)
            ->on('bar value', new HashPicker('bar'))
            ->applyOn($target, 'valid hash', $mockedResult);
    }

}
