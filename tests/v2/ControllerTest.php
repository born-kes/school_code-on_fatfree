<?php
declare(strict_types = 1);
namespace tests\v2;

use PHPUnit\Framework\TestCase;
use interfaces\IController;

/**
 * @property \v2\Controllers\Main mainController
 */
class ControllerTest extends TestCase
{

    public function testController()
    {
        # Arrange / Given
        $f3 = '';
        $params = [];
        $router = '';

        # Act / When
        $mainController = new \v2\Controllers\Main($f3, $params, $router);

        # Assert
        $this->assertTrue($mainController instanceof IController, 
			'Not implement controller interface'
		);

    }

    public function testResponse()
    {
        # Arrange / Given

        $executing = 'newfoo';
        $params = [];
        $router = '';

        $stub = $this->createMock(\interfaces\IView::class);
        $stub->method('get')
            ->willReturn($executing);

        $f3 = $this->createStub(\interfaces\IBase::class);
        $f3->method('get')->willReturn($this->returnValue($stub));

        # Act / When
        $mainController = new \v2\Controllers\Main($f3, $params, $router);

        #Assert /
        $this->expectOutputString($executing);
        echo $mainController->response($f3);
    }

    public function testMockMethodsGetView(){

        $executing = 'Message Exception';

        $f3 = $this->createStub(\interfaces\IBase::class);
        $f3->method('get');

        $created = $this->getMockBuilder('\v2\Controllers\Main')
            ->setConstructorArgs([$f3, '$params', '$router'])
            ->onlyMethods(['getView'])
            ->getMock();

        $created->method('getView')
            ->withAnyParameters()
            ->will($this->throwException(new \Exception($executing)));

        $this->expectOutputString($executing);
        echo $created->response($f3);

    }
}