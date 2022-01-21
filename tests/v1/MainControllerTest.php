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
        $this->f3->config('routes_v1.ini');

        $this-> f3->set('CONTROLLER_PAGE', '\stub\FactoryPage');
        $this-> f3->set('CONTROLLER_VIEW', '\stub\ViewController');
//        $this-> f3->set('NAMESPACE_PAGE', 'v1\Page');
    }

    function testValidateXConfig()
    {
        $this->assertNotTrue(empty($this->f3->get('ROUTES')), 'Route is NOT empty');
        $this->assertNotNull($this->f3->get('ROUTES'), 'Routes is NOT NULL');
        $this->assertTrue(is_array($this->f3->get('ROUTES')), 'Router is not array');
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
            'stub\FactoryPage::__construct => Base',
            'stub\ViewController::__construct => Base'
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
        $response = $controller->response($this->f3);
        if( !$response )
            $response = ob_get_contents();
        ob_end_clean();

        return $response;
    }
}