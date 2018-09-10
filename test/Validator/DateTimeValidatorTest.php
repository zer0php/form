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
     * @dataProvider invalidDateTimeProvider
     */
    public function validate_givenInvalidDate_throwsExceptionWithErrorMessage($dateTime) {
        $validator = new DateTimeValidator();
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Wrong datetime format');
        $validator->validate($dateTime);
    }

    public function invalidDateTimeProvider()
    {
        return [
            [''],
            ['wrong date format'],
            ['a'],
            ['2010.01.01 12:00:00'],
            ['2010-01-01 12.00.00'],
            ['2010-01-01 12'],
            ['2010-01 12:00:00'],
        ];
    }


    /**
     * @test
     * @dataProvider validDateTimeProvider
     */
    public function validate_givenValidEmail_returnsNull($dateTime) {
        $emptyValidator = new DateTimeValidator();
        $this->assertNull($emptyValidator->validate($dateTime));

    }

    public function validDateTimeProvider()
    {
        return [
            ['2010-01-01 12:00:00'],
            ['2010-01-01 12:00'],
            ['2010-1-1 12:00'],
            ['2010-1-1 1:1:1']
        ];
    }
}