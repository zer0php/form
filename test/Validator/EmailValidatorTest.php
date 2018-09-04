<?php

namespace Test\Validator;

use Zero\Form\Validator\ValidationException;
use PHPUnit\Framework\TestCase;

/**
 * Class EmptyValidatorTest
 * @package Test\Validator
 */
class EmailValidatorTest extends TestCase {

    /**
     * @test
     */
    public function validate_givenInvalidEmail_throwsExceptionWithErrorMessage() {
        $emptyValidator = new \Zero\Form\Validator\EmailValidator();
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Wrong email format');
        $emptyValidator->validate('a@');
    }

    /**
     * @test
     */
    public function validate_givenValidEmail_returnsNull() {
        $emptyValidator = new \Zero\Form\Validator\EmailValidator();
        $this->assertNull($emptyValidator->validate('test@test.test'));

    }
}