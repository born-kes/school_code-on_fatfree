<?php
namespace stub;

use v1\MyPageController;
use PHPUnit\Framework\TestCase;

class MyPageControllerTest extends TestCase
{

    /**
     * @var \Base
     */
    private $f3;

    function setUp(): void
    {
        $this->f3 = \Base::instance();
        $this->f3->set('QUIET',TRUE);
        $this->f3->config('config.ini');
        $this->f3->set('NAMESPACE_PAGE', 'stub');

        /** autoload file Pages and class in file
         * stub Home, Generator
         * and Fake Lib
         */
        new Page($this->f3);
        /** No Exist Page */
        $this->f3->mock('GET /xyz11');

        Aggregator::clineDataAggregator();
    }

    /**
     *  Test implements Interface PageControllerInterface
     */
    function testConstructor()
    {
        $pageController = new MyPageController($this->f3);

        $this->assertInstanceOf('v1\interfaces\PageControllerInterface', $pageController);
    }

    /**
     *  test createPageList and private getClassForCurrentPage
     * return list pages [ url => '...' , text => '...' ]
     */
    function testGetPageList ()
    {
        $pageController = new MyPageController($this->f3);
        $response = $pageController->getPageList();

        $this->assertIsArray($response);
        foreach($response as $val ){
            $this->assertCount(2, $val );
            $this->assertArrayHasKey('url', $val);
            $this->assertArrayHasKey('text', $val);
            $this->assertArrayNotHasKey('class', $val);
        }
    }

    /**
     * Test getContentFromControllerClass from not exist page
     *
     * $DefaultClassForCurrentPage = Home
     * Stub/Home extends in Page file
     */
    function testGetContentFromDefaultPage ()
    {
        $pageController = new MyPageController($this->f3);

        /** Index return string by view */
        $expected = 'text from Page : Home';
        Aggregator::setConfigParams(['stub\Home::index' => $expected ]);
        $this->assertEquals($expected, $pageController->getContentFromControllerClass());

        /** Index return function by view */
        $expected2 = function () {};
        Aggregator::setConfigParams(['stub\Home::index' => $expected2]);
        $response = $pageController->getContentFromControllerClass();

        $this->assertEquals($expected2, $response);
    }

    /**
     * Test getContentFromControllerClass from exist page
     *
     * page Generator include Class Generator but
     * Stub/Generator extends in Page file
     */
    function testGetContentFromExistClass ()
    {
        $expected = 'text from Page : Generator';
        Aggregator::setConfigParams(['stub\Generator::index'=> $expected ]);

        /** Exist Page */
        $this->f3->mock('GET /Generator ');

        /** Index return string by view */
        $pageController = new MyPageController($this->f3);
        $this->assertEquals($expected, $pageController->getContentFromControllerClass());

        /** Index return function by view */
        $expected2 = function () {};
        Aggregator::setConfigParams(['stub\Generator::index'=> $expected2  ]);
        $response = $pageController->getContentFromControllerClass();

        $this->assertEquals($expected2, $response);
    }

    /**
     * test private function checkingClassController
     *
     * Fake class Lib in stub/Page file
     */
    function testDefenseAgainstGetErrorClassContent () {

        $this->f3->mock('GET /Archiwum/lib ');

        $this->assertNotInstanceOf('v1\interfaces\PageInterface', new Lib);

        $this->assertEquals( "stub\Home::index", Aggregator::retrieveAggregatorCallData(1) );
    }
}
