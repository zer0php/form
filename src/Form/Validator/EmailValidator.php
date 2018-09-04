<?php

namespace Zero\Form\Validator;

/**
 * Class EmailValidator
 * @package Zero\Form\Validator
 */
class EmailValidator implements ValidatorInterface
{
    public function validate($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException('Wrong email format');
        }
    }
}