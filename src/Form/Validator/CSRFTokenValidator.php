<?php

namespace Zero\Form\Validator;

/**
 * Class CSRFTokenValidator
 * @package Zero\Form\Validator
 */
class CSRFTokenValidator implements ValidatorInterface
{
    const TOKEN_KEY = '_csrf_token';

    /**
     * @throws ValidationException
     * @return void
     */
    public function validate($value)
    {
        if ($value !== $this->getToken()) {
            throw new ValidationException('Token mismatch');
        }
        $this->generateNewToken();
    }

    private function generateNewToken()
    {
        $_SESSION[self::TOKEN_KEY] = hash('sha256', microtime() . uniqid(self::TOKEN_KEY) . mt_rand(1, 10000));
    }

    public function getToken()
    {
        if (!isset($_SESSION[self::TOKEN_KEY])) {
            $this->generateNewToken();
        }
        return $_SESSION[self::TOKEN_KEY];
    }
}