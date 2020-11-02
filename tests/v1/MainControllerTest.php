<?php
namespace v1;
use Base;
use PHPUnit\Framework\TestCase;
use stub\Aggregator;
use v1\MainController;

class MainControllerTest extends TestCase
{
    protected $f3;

    protected function setUp(): void
    {
        $this->f3 = Base::instance();
        $this->f3->set('QUIET',TRUE);
        $this->f3->config('config.ini');

        $this-> f3->set('CONTROLLER_PAGE', '\stub\PageController');
        $this-> f3->set('CONTROLLER_VIEW', '\stub\ViewController');
//        $this-> f3->set('NAMESPACE_PAGE', 'v1\Page');
    }

    protected function tearDown(): void
    {
        Aggregator::clineDataAggregator();
    }

    /**
     * @test
     */
    public function shouldWhenBuildMainControllerThenBuildDependentClasses()
    {
        # Arrange / Given
        // setUp
        Aggregator::setConfigParams(
            ['stub\ViewController::response' => 'xyz']
        );
        $respons = [
            "stub\PageController::__construct => Base",
            "stub\ViewController::__construct => Base"
        ];

        # Act / When
        new MainController($this->f3);

        # Assert / That
        $this->assertTrue($respons[0] == Aggregator::retrieveAggregatorCallData(0));
        $this->assertTrue($respons[1] == Aggregator::retrieveAggregatorCallData(1));
        $this->assertTrue(NULL == Aggregator::retrieveAggregatorCallData(2));
    }

    /**
     * @test
     */
    public function shouldWhenMockControllerViewResponseString_ThenMainControllerResponseThisString()
    {
        # Arrange / Given
        $expected = '<body></body>';
        Aggregator::setConfigParams(
            ['stub\ViewController::response' => $expected]
        );

        # Act / When
        $response = $this->getResponseController();

        # Assert / That
        $this->assertNotEmpty($response, 'I have Empty response.');
        $this->assertEquals($response, $expected, 'Response Controller is not expected response.');
    }



    protected function getResponseController ($url = 'GET /') :string
    {

        $this->f3->mock($url);
        $controller = new MainController($this->f3);

        ob_start();
        $controller->response($this->f3);
        $response = ob_get_contents();
        ob_end_clean();

        return $response;
    }
}