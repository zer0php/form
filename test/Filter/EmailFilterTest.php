<?php

namespace Test\Filter;

use Zero\Form\Filter\EmailFilter;
use PHPUnit\Framework\TestCase;

/**
 * Class EmailFilterTest
 * @package Test\Filter
 */
class EmailFilterTest extends TestCase
{
    /**
     * @test
     */
    public function filter_GivenValidEmail_ReturnsSameValue() {
        $value = 'test@test.com';
        $filter = new EmailFilter();
        $this->assertEquals('test@test.com', $filter->filter($value));
    }

    /**
     * @test
     */
    public function filter_GivenInValidEmail_ReturnsCleanedValue() {
        $value = 'test(_test)@test.com';
        $filter = new EmailFilter();
        $this->assertEquals('test_test@test.com', $filter->filter($value));
    }
}