# ZeroPHP Form

[![Build Status](https://travis-ci.com/zer0php/form.svg?branch=master)](https://travis-ci.com/zer0php/form)
[![Coverage Status](https://coveralls.io/repos/github/zer0php/form/badge.svg?branch=master)](https://coveralls.io/github/zer0php/form?branch=master)
[![Latest Stable Version](https://poser.pugx.org/zer0php/form/v/stable)](https://packagist.org/packages/zer0php/form)

```php
use Zero\Form\Form;
use Zero\Form\Filter\StringFilter;
use Zero\Form\Filter\EmailFilter;
use Zero\Form\Validator\EmptyValidator;
use Zero\Form\Validator\EmailValidator;

$form = new Form();
$form
    ->input('name', new StringFilter(), new EmptyValidator('Name'))
    ->input('email', new EmailFilter(), new EmailValidator());
    
/* @var $request \Psr\Http\Message\ServerRequestInterface */
if($form->handle($request)->isValid()) {
    $data = $form->getData(); //['name' => 'Test name', 'email' => 'test@test.test']
} else {
    $errors = $form->getErrors(); //['name' => 'Name can not be empty', 'email' => 'Wrong email format']
}
```