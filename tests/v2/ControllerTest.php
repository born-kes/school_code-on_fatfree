<?php
declare(strict_types = 1);
namespace tests\v2;

use interfaces\IController;
use PHPUnit\Framework\TestCase;

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
        $stub = $this->_buildMock(\interfaces\IView::class, 'get', $executing);
        $f3 = $this->_buildStub(\interfaces\IBase::class, 'get', $stub);

        # Act / When
        $mainController = new \v2\Controllers\Main($f3, $params, $router);

        # Assert / Then
        $this->expectOutputString($executing);
        echo $mainController->response($f3);
    }

    /** auxiliary
     * @param $interface
     * @param string $method
     * @param mixed $return
     * @return stdClass
     */
    private function _buildMock($interface, string $method, $return = null)
    {
        $mock = $this->createMock($interface);
        return $this->_build(
            $mock,
            $method,
            $return
        );
    }

    private function _build($stub, string $method, $return = null)
    {
        if (is_null($return)) {
            $stub->method($method);
        } else if (!is_array($return)) {
            $stub->method($method)->willReturn($return);
        } else {
            $stub->method($method)->willReturn($this->onConsecutiveCalls($return));
        }
        return $stub;
    }

    private function _buildStub($interface, $method, $return = null)
    {
        $stub = $this->createStub($interface);
        return $this->_build(
            $stub,
            $method,
            $return
        );
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
}