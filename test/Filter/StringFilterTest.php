<?php

namespace Test\Filter;

use PHPUnit\Framework\TestCase;
use Zero\Form\Filter\StringFilter;

/**
 * Class StringFilterTest
 * @package Test\Filter
 */
class StringFilterTest extends TestCase
{
    /**
     * @test
     */
    public function filter_GivenValidData_ReturnsSameValue() {
        $value = 'Test string';
        $filter = new StringFilter();
        $this->assertEquals('Test string', $filter->filter($value));
    }

    /**
     * @test
     */
    public function filter_GivenInValidData_ReturnsCleanedValue() {
        $value = 'Test string<br>';
        $filter = new StringFilter();
        $this->assertEquals('Test string', $filter->filter($value));
    }

    /**
     * @test
     */
    public function filter_GivenOnlyWhitespacesData_ReturnsEmptyValue() {
        $value = '     ';
        $filter = new StringFilter();
        $this->assertEquals('', $filter->filter($value));
    }

    /**
     * @test
     */
    public function filter_GivenArrayData_ReturnsEmptyValue() {
        $value = [];
        $filter = new StringFilter();
        $this->assertEquals('', $filter->filter($value));
    }
}