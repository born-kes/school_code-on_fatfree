<?php
declare(strict_types=1);
namespace tests\v2;
use PHPUnit\Framework\TestCase;
use interfaces\IController;

/**
 * @property \v2\Controllers\Main mainController
 */
class ControllerTest extends TestCase
{
    private IController $mainController;

    protected function setUp():void
    {
        $f3 = '';
        $params = [];
        $router = '';
        $this->mainController = new \v2\Controllers\Main($f3, $params, $router);
    }

    public function testController()
    {
        # Arrange / Given

        # Act / When


        #Assert /
        $this->assertTrue(true);
//!empty($this->mainController)
    }
}