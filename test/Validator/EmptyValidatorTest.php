<?php

namespace Test\Validator;

use Zero\Form\Validator\EmptyValidator;
use Zero\Form\Validator\ValidationException;
use PHPUnit\Framework\TestCase;

/**
 * Class EmptyValidatorTest
 * @package Test\Validator
 */
class EmptyValidatorTest extends TestCase {

    /**
     * @test
     */
    public function validate_givenEmptyString_throwsExceptionWithErrorMessage() {
        $emptyValidator = new EmptyValidator('Name');
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Name can not be empty');
        $emptyValidator->validate('');
    }

    /**
     * @test
     */
    public function validate_givenNotEmptyString_ReturnsNull() {
        $emptyValidator = new EmptyValidator('Name');
        $this->assertNull($emptyValidator->validate('Test name'));
    }
}