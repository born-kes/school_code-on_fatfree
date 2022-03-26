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
        # Arrange / Given
        $executing = '<html></html>';
        $ProductionF3 = \Base::instance();
        $stub = $this->_buildMock(\interfaces\IView::class, 'get', $executing);
        $mockBase = $this->_buildStub(\interfaces\IBase::class, 'get', $stub);
        $mockMainController = $this->getMockBuilder('\v2\Controllers\Main')
          ->setConstructorArgs([$ProductionF3, ['$params'], '$router'])
          ->onlyMethods(['getABase'])
          ->getMock('$mockBase');
        $mockMainController->method('getABase')->willReturn($mockBase);

        # Assert / Then
        $response = $mockMainController->response($ProductionF3, ['$params'], '$router');

        # Act / When
        $this->assertEquals($executing, $response);
    }

}
