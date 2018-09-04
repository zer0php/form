# ZeroPHP Form

```php
use Zero\Form\Form;
use Zero\Form\Filter\StringFilter;
use Zero\Form\Filter\EmailFilter;
use Zero\Form\Validator\EmptyValidator;
use Zero\Form\Validator\EmailValidator;

...

$form = new Form();
$form
    ->input('name', new StringFilter(), new EmptyValidator('Name'))
    ->input('email', new EmailFilter(), new EmailValidator());
    
/* @var $postRequest \Psr\Http\Message\ServerRequestInterface */
if($form->handle($postRequest)->isValid()) {
    $data = $form->getData(); //['name' => 'Test name', 'email' => 'test@test.test']
} else {
    $errors = $form->getErrors(); //['name' => 'Name can not be empty', 'email' => 'Wrong email format']
}
```
