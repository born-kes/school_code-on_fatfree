<?php
declare(strict_types=1);
namespace tests\v2;

use interfaces\IController;

/**
 * @property \v2\Controllers\Main mainController
 */
class ControllerTest extends ControllerTestBase
{

    /**
     * @group version2
     */
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
                          self::Not_implement_controller_interface
        );
    }

    public function testResponse()
    {
        # Arrange / Given

        $executing = 'newfoo';
        $params = [];
        $router = '';
        $stub = $this->_buildMock(\interfaces\IView::class, 'get', $executing);
        $f3 = $this->_buildStub(\interfaces\IBase::class, 'get', $stub);

        # Act / When
        $mainController = new \v2\Controllers\Main($f3, $params, $router);

        # Assert / Then
        $this->expectOutputString($executing);
        echo $mainController->response($f3);
    }

    public function testMockMethodsGetView()
    {
        # Arrange / Given
        $executing = 'Message Exception';
        $f3 = $this->_buildStub(\interfaces\IBase::class, 'get');
        $created = $this->getMockBuilder('\v2\Controllers\Main')
          ->setConstructorArgs([$f3, '$params', '$router'])
          ->onlyMethods(['getView'])
          ->getMock();

        $created->method('getView')
          ->withAnyParameters()
          ->will($this->throwException(new \Exception($executing)));

        # Assert / Then
        $this->expectOutputString($executing);

        # Act / When
        echo $created->response($f3);
    }

    /**
     * @test
     * @group version2
     */
    public function shouldUseAdapterBase()
    {
        $ProductionF3 = '\Base::instance()';
        $mockBase = $this->_buildMock(
          \interfaces\IBase::class,
          ['get' => null, 'config' => null]
        );

        # Arrange / Given
        $mockMainController = $this->getMockBuilder('\v2\Controllers\Main')
          ->setConstructorArgs([$ProductionF3, ['$params'], '$router'])
          ->onlyMethods(['getABase'])
          ->getMock();

        $mockMainController
          ->expects($this->once())
          ->method('getABase')->with($ProductionF3)
          ->willReturn($mockBase);

        # Assert / Then
        $mockMainController->response($ProductionF3, ['$params'], '$router');

        # Act / When
    }

    /**
     * @test
     * @testdox Controller should return data from View, but use data from ABase
     * @group version2
     */
    public function shouldReturnDataFromViewAndUseAdapterBase()
    {
        $executing = '<html></html>';
        $instanceF3 = \Base::instance();
        $stubClassF3 = $this->_buildStub(\interfaces\IBase::class);
        $stubClassF3->method('get')->willReturn('dataPage');

        $mockView = $this->createMock(\interfaces\IView::class);
        $mockView
          ->expects($this->once())
          ->method('get')->with($stubClassF3, 'dataPage')
          ->willReturn('<html></html>');

        # Arrange / Given
        $mockMainController = $this->getMockBuilder('\v2\Controllers\Main')
          ->setConstructorArgs([$instanceF3, ['$params'], '$router'])
          ->onlyMethods(['getABase', 'getView'])
          ->getMock();

        $mockMainController->method('getABase')->willReturn($stubClassF3);
        $mockMainController->method('getView')->willReturn($mockView);

        # Assert / Then
        $response = $mockMainController->response($instanceF3, ['$params'], '$router');

        # Act / When
        $this->assertEquals($executing, $response);
    }

}
