<?php

namespace Zero\Form\Validator;

/**
 * Interface ValidatorInterface
 * @package Zero\Form\Validator
 */
interface ValidatorInterface
{
    /**
     * @throws ValidationException
     * @return void
     */
    public function validate($value);
}