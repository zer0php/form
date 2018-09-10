<?php

namespace Test\Validator;

use Zero\Form\Validator\DateTimeValidator;
use Zero\Form\Validator\ValidationException;
use PHPUnit\Framework\TestCase;

/**
 * Class DateTimeValidatorTest
 * @package Test\Validator
 */
class DateTimeValidatorTest extends TestCase {

    /**
     * @test
     */
    public function validate_givenInvalidDate_throwsExceptionWithErrorMessage() {
        $validator = new DateTimeValidator();
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Wrong datetime format');
        $validator->validate('wrong date format');
    }


    /**
     * @test
     */
    public function validate_givenValidEmail_returnsNull() {
        $emptyValidator = new DateTimeValidator();
        $this->assertNull($emptyValidator->validate('2018-09-10 13:08'));

    }
}