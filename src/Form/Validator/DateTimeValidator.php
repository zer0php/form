<?php

namespace Zero\Form\Validator;

/**
 * Class DateTimeValidator
 * @package Zero\Form\Validator
 */
class DateTimeValidator implements ValidatorInterface
{
    const REGEX_DATE = '\d\d\d\d-(0?[1-9]|1[0-2])-(0?[1-9]|[12][0-9]|3[01])';
    const REGEX_TIME = '(00|[0-9]|1[0-9]|2[0-3]):([0-9]|[0-5][0-9]):?([0-9]|[0-5][0-9])';

    /**
     * @throws ValidationException
     * @return void
     */
    public function validate($value)
    {
        if(!preg_match('#^' . self::REGEX_DATE . ' ' . self::REGEX_TIME . '$#', $value)) {
            throw new ValidationException('Wrong datetime format');
        }
    }
}