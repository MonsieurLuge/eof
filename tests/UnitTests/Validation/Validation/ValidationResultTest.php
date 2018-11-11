<?php

namespace App\UnitTests\Validation;

use EOF\Validation\SimpleValidationResult;
use PHPUnit\Framework\TestCase;

final class SimpleValidationResultTest extends TestCase
{

    /** @var SimpleValidationResult **/
    private $testSubject;

    public function setUp()
    {
        $this->testSubject = new SimpleValidationResult();
    }

    /**
     * No error must be returned.
     * @covers EOF\Validation\SimpleValidationResult::errors
     */
    public function testErrorsWithoutAddingASingleOne()
    {
        $this->assertEquals(
            [],
            $this->testSubject->errors()
        );
    }

    /**
     * The added errors must be returned.
     * @covers EOF\Validation\SimpleValidationResult::addError
     * @covers EOF\Validation\SimpleValidationResult::errors
     */
    public function testErrorsWithSomeErrors()
    {
        $errors = $this->testSubject
            ->addError('error n°3')
            ->addError('error n°1')
            ->addError('error n°2')
            ->errors();

        sort($errors);

        $this->assertEquals(
            [ 'error n°1', 'error n°2', 'error n°3' ],
            $errors
        );
    }

    /**
     * The error given by default must be returned as is.
     * @covers EOF\Validation\SimpleValidationResult::errors
     */
    public function testErrorsWithADefaultOne()
    {
        $testSubject = new SimpleValidationResult([ 'lonely error' ]);

        $this->assertEquals(
            [ 'lonely error' ],
            $testSubject->errors()
        );
    }

    /**
     * The added errors must be returned.
     * @covers EOF\Validation\SimpleValidationResult::addError
     * @covers EOF\Validation\SimpleValidationResult::errors
     */
    public function testErrorsWithSomeErrorsAndADefaultOne()
    {
        $testSubject = new SimpleValidationResult([ 'not so lonely error' ]);

        $errors = $testSubject
            ->addError('error n°3')
            ->addError('error n°1')
            ->addError('error n°2')
            ->errors();

        sort($errors);

        $this->assertEquals(
            [ 'error n°1', 'error n°2', 'error n°3', 'not so lonely error' ],
            $errors
        );
    }

    /**
     * The result must be valid when no error was added to the set.
     * @covers EOF\Validation\SimpleValidationResult::validated
     */
    public function testValidatedWithNoErrors()
    {
        $this->assertEquals(
            true,
            $this->testSubject->validated()
        );
    }

    /**
     * The result must not be valid when some errors were added to the set.
     * @covers EOF\Validation\SimpleValidationResult::validated
     */
    public function testValidatedWithSomeErrors()
    {
        $updatedResult = $this->testSubject
            ->addError('error n°3')
            ->addError('error n°1')
            ->addError('error n°2');

        $this->assertEquals(
            false,
            $updatedResult->validated()
        );
    }

    /**
     * The result must not be valid when a default error is present in the set.
     * @covers EOF\Validation\SimpleValidationResult::validated
     */
    public function testValidatedWithADefaultError()
    {
        $testSubject = new SimpleValidationResult([ 'lonely error' ]);

        $this->assertEquals(
            false,
            $testSubject->validated()
        );
    }

    /**
     * The result must not be valid when some errors were added to the set.
     * @covers EOF\Validation\SimpleValidationResult::validated
     */
    public function testValidatedWithMoreErrors()
    {
        $testSubject = new SimpleValidationResult([ 'lonely error' ]);

        $updatedResult = $testSubject
            ->addError('error n°3')
            ->addError('error n°1')
            ->addError('error n°2');

        $this->assertEquals(
            false,
            $updatedResult->validated()
        );
    }

}
