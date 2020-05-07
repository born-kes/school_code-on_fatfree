<?php
namespace tests;
use PHPUnit\Framework\TestCase;
use stub\Aggregator;

include ('stub\Aggregator.php');

include ('stub\MyPageController.php');
include ('stub\Page.php');
include ('Stub\Template.php');
class MainControllerTest extends TestCase
{
    protected $f3;

    protected function setUp(): void
    {
        Aggregator::setConfigByTests([
            'v1\MyPageController::getClassForCurrentPage' => 'Page',
            'v1\MyPageController::getPageList' =>[],
            'Template::render' => 'layout.html'
        ]) ;

        $this->f3 = Base::instance();
        $this->f3->set('QUIET',TRUE);
        $this->f3->config('config.ini');
        $this->f3->mock('GET /ftp');
//        Aggregator::unsetAggregatro();
    }

    /**
     */
    protected function tearDown(): void
    {
        Aggregator::unsetAggregatro();
    }

    public function testBaseMock(){
        $this->assertIsArray( Aggregator::getAggregatorCallByTest(),
            'Base->Mock launched MainCortroller');
    }
    public function testIndexReplyToUser()
    {
        ob_start();
            \v1\MainController::index($this->f3);
        $html = ob_get_contents();
        ob_end_clean();

//        var_dump(Aggregator::getAggregatorCallByTest());

        $this->assertNotEmpty($html);
    }
}