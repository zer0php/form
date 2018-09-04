<?php

namespace Zero\Form\Validator;

/**
 * Class ValidatorChain
 * @package Zero\Form\Validator
 */
class ValidatorChain implements ValidatorInterface
{
    /**
     * @var ValidatorInterface[]
     */
    private $validators = [];

    public function add(ValidatorInterface $validator)
    {
        $this->validators[] = $validator;
        return $this;
    }

    public function validate($value)
    {
        $errors = [];
        foreach ($this->validators as $validator) {
            try {
                $validator->validate($value);
            } catch (ValidationException $ex) {
                $errors[] = $ex->getMessage();
            }
        }
        if (!empty($errors)) {
            throw new ValidationException(implode("\n", $errors));
        }
    }
}