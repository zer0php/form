<?php

namespace Zero\Form\Filter;

/**
 * Class StringFilter
 * @package Zero\Form\Filter
 */
class StringFilter implements FilterInterface
{
    public function filter($value) {
        return trim(filter_var($value, FILTER_SANITIZE_STRING));
    }
}