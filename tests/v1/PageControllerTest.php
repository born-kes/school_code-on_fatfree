<?php
namespace v1;

use PHPUnit\Framework\TestCase;
use stub\Aggregator;

class PageControllerTest extends TestCase
{

    /**
     * @var \Base
     */
    private $f3;
    private $mock;

    function setUp(): void
    {
        $this->f3 = \Base::instance();
        $this->f3->set('QUIET',TRUE);
        $this->f3->config('config.ini');

    }
    protected function tearDown(): void
    {
        Aggregator::clineDataAggregator();
    }

    protected function getBaseMock($url = 'GET /')
    {
       return $this->f3->mock($url);
    }
    /**
     *  Test implements Interface PageControllerInterface
     * @test
     */
    function WhenUrlNotExist_ShouldPageControllerReturnHomePage()
    {
        # Arrange / Given
        $thisUrlShouldNotExist = 'GET /xxxxxx_YYSYS';

        # Act / When
        $this->getBaseMock($thisUrlShouldNotExist);
        $pageController = new PageController($this->f3);

        #Assert / That
        $this->assertInstanceOf('v1\interfaces\PageControllerInterface', $pageController);
    }

    /**
     *  test createPageList and private getClassForCurrentPage
     * return list pages [ url => '...' , text => '...' ]
     * @test
     */
    function getPageListShouldReturnArrayHaveOnlyKeyUrlAndText ()
    {
        # Arrange / Given
        $pageController = new PageController($this->f3);

        # Act / When
        $response = $pageController->getPageList();

        #Assert / That
        $this->assertIsArray($response);

        foreach($response as $val ){
            $this->assertCount(2, $val );
            $this->assertArrayHasKey('url', $val);
            $this->assertArrayHasKey('text', $val);
            $this->assertArrayNotHasKey('class', $val);
        }
    }

    /**
     * @test
     */
    function _getContentFromDefaultPage ()
    {
        # Arrange / Given
        $pageController = new PageController($this->f3);
        $expected = 'Hello';

        # Act / When
        $response = $pageController->getContentFromControllerClass();

        #Assert / That
        $this->assertEquals($expected, $response);

    }

    /**
     * Test getContentFromControllerClass from exist page
     *
     * page Generator include Class Generator but
     * Stub/Generator extends in Page file
     */
    function t_estGetContentFromExistClass ()
    {
        $expected = 'text from Page : Generator';
        Aggregator::setConfigParams(['stub\Generator::index'=> $expected ]);

        /** Exist Page */
        $this->f3->mock('GET /Generator ');

        /** Index return string by view */
        $pageController = new PageController($this->f3);
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
    function t_estDefenseAgainstGetErrorClassContent () {

        $this->f3->mock('GET /Archiwum/lib ');

        $this->assertNotInstanceOf('v1\interfaces\PageInterface', new Lib);

        $this->assertEquals( "stub\Home::index", Aggregator::retrieveAggregatorCallData(1) );
    }
}
