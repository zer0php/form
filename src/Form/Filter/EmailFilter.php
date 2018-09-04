<?php

namespace Zero\Form\Filter;

/**
 * Class EmailFilter
 * @package Zero\Form\Filter
 */
class EmailFilter implements FilterInterface
{
    public function filter($value)
    {
        return filter_var($value, FILTER_SANITIZE_EMAIL);
    }
}