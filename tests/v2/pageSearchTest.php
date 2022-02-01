<?php
declare(strict_types = 1);
namespace tests\v2;

use interfaces\IController;

class pageSearchTest extends ControllerTestBase
{
    public function testPageImplementInterfaceController()
    {
        # Arrange / Given
        $f3 = '';
        $params = [];
        $router = '';

        # Act / When
        $mainController = new \v2\Controllers\Search($f3, $params, $router);

        # Assert
        $this->assertTrue($mainController instanceof IController,
            self::Not_implement_controller_interface
        );

    }

    function testFirstCallingPageSearch()
    {
        # Arrange / Given
        $f3 = $this->_buildMock(\interfaces\IBase::class, 'get');

        $params = [0 => 'search/'];
        $router = '';

        # Act / When
        $this->mainController = new \v2\Controllers\Search($f3, $params, $router);

        # Assert / then
       $this->assertNotEmpty( $this->mainController->response($f3, $params, $router) );

    }

}