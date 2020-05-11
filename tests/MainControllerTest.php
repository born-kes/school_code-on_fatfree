<?php
namespace tests;
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
        $this->f3->mock('GET /ftp');
    }

    /**
     */
    protected function tearDown(): void
    {
        Aggregator::unsetAggregator();
    }

    /**
     * View and Page have same interface
     */
    public function testFinalResponseFromIndexView()
    {
        $this->f3->set('CONTROLLER_VIEW', 'stub\\Page');
        Aggregator::setConfigByTests(['stub\Page::index'=>'<body></body>']);

        $controller = new MainController($this->f3);

        ob_start();
            $controller->index($this->f3);
        $html = ob_get_contents();
        ob_end_clean();

        $this->assertNotEmpty($html);
        $this->assertEquals($html, '<body></body>');
    }
}