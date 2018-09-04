<?php

namespace Zero\Form;

use Zero\Form\Filter\FilterInterface;
use Zero\Form\Validator\ValidationException;
use Zero\Form\Validator\ValidatorInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Form
 * @package Zero\Form
 */
class Form
{
    /**
     * @var array
     */
    private $inputs = [];

    /**
     * @var FilterInterface[]
     */
    private $filters = [];

    /**
     * @var ValidatorInterface[]
     */
    private $validators = [];

    /**
     * @var array
     */
    private $data = [];

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param string $name
     * @param FilterInterface $filter
     * @param ValidatorInterface|null $validator
     * @return self
     */
    public function input(string $name, FilterInterface $filter, ValidatorInterface $validator = null) {
        if(in_array($name, $this->inputs)) {
            throw new \InvalidArgumentException(sprintf('An input named "%s" has already been added!', $name));
        }
        $this->inputs[] = $name;
        $this->data[$name] = null;
        $this->filters[$name] = $filter;
        if($validator) {
            $this->validators[$name] = $validator;
        }
        return $this;
    }

    /**
     * @param ServerRequestInterface $request
     * @return self
     */
    public function handle(ServerRequestInterface $request)
    {
        $postData = $request->getParsedBody();
        foreach ($this->inputs as $name) {
            $value = isset($postData[$name]) ? $postData[$name] : null;
            $filter = $this->filters[$name];
            $this->data[$name] = $filter->filter($value);
        }
        return $this;
    }

    public function validate()
    {
        $data = $this->getData();
        $this->errors = [];
        foreach($this->validators as $name => $validator) {
            try {
                $validator->validate($data[$name]);
            } catch (ValidationException $ex) {
                $this->errors[$name] = $ex->getMessage();
            }
        }
        return empty($this->errors);
    }


}