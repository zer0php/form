<?php

namespace Test\Form;

use Zero\Form\Filter\EmailFilter;
use Zero\Form\Filter\StringFilter;
use Zero\Form\Form;
use Zero\Form\Validator\EmailValidator;
use Zero\Form\Validator\EmptyValidator;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FormTest
 * @package Test\Form
 */
class FormTest extends TestCase
{

    /**
     * @var Form
     */
    private $form;
    
    protected function setUp()
    {
        $this->form = new Form();
    }

    /**
     * @test
     */
    public function handle_GivenSomeInputAndRequest_ReturnsFilteredData()
    {
        $mockRequest = $this->createMock(ServerRequestInterface::class);
        $mockRequest
            ->expects($this->once())
            ->method('getParsedBody')
            ->willReturn([
                'name' => 'Test name<br>',
                'email' => 'test@test.test()',
                'message' => 'Test message<br>',
            ]);

        $this->form
            ->input('name', new StringFilter())
            ->input('email', new EmailFilter())
            ->input('message', new StringFilter());

        $data = $this->form->handle($mockRequest)->getData();
        $this->assertCount(3, $data);
        $this->assertEquals('Test name', $data['name']);
        $this->assertEquals('test@test.test', $data['email']);
        $this->assertEquals('Test message', $data['message']);
    }

    /**
     * @test
     */
    public function handle_GivenSomeInputAndRequestWithoutInputDatas_ReturnsDataWithNullValues()
    {
        $mockRequest = $this->createMock(ServerRequestInterface::class);
        $mockRequest
            ->expects($this->once())
            ->method('getParsedBody')
            ->willReturn([
                'not-exists' => null
            ]);

        $this->form
            ->input('name', new StringFilter())
            ->input('email', new EmailFilter())
            ->input('message', new StringFilter());

        $data = $this->form->handle($mockRequest)->getData();
        $this->assertCount(3, $data);
        $this->assertEquals('', $data['name']);
        $this->assertEquals('', $data['email']);
        $this->assertEquals('', $data['message']);
    }

    /**
     * @test
     */
    public function add_GivenSameInputs_ThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->form
            ->input('name', new StringFilter())
            ->input('name', new StringFilter());
    }

    /**
     * @test
     */
    public function isValid_GivenSomeInputsWithInvalidDataAndValidator_ReturnFalse()
    {
        $mockRequest = $this->createMock(ServerRequestInterface::class);
        $mockRequest
            ->expects($this->once())
            ->method('getParsedBody')
            ->willReturn([
                'name' => '',
                'email' => 'testtest.test',
            ]);

        $this->form
            ->input('name', new StringFilter(), new EmptyValidator('Name'))
            ->input('email', new StringFilter(), new EmailValidator());

        $isValid = $this->form
            ->handle($mockRequest)
            ->isValid();
        $this->assertFalse($isValid);
        $this->assertEquals([
            'name' => 'Name can not be empty',
            'email' => 'Wrong email format',
        ], $this->form->getErrors());
    }

    /**
     * @test
     */
    public function isValid_GivenSomeInputsWithValidAndInvalidDataAndValidator_ReturnFalse()
    {
        $mockRequest = $this->createMock(ServerRequestInterface::class);
        $mockRequest
            ->expects($this->once())
            ->method('getParsedBody')
            ->willReturn([
                'name' => 'Valid Name',
                'email' => 'testtest.test',
            ]);

        $this->form
            ->input('name', new StringFilter(), new EmptyValidator('Name'))
            ->input('email', new StringFilter(), new EmailValidator());

        $isValid = $this->form
            ->handle($mockRequest)
            ->isValid();

        $this->assertFalse($isValid);
        $this->assertEquals([
            'email' => 'Wrong email format',
        ], $this->form->getErrors());

        $this->assertEquals([
            'name' => 'Valid Name',
            'email' => null,
        ], $this->form->getValidData());
    }

}