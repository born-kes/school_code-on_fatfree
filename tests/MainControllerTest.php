<?php
use PHPUnit\Framework\TestCase;
//include ('vendor\bcosca\fatfree-core\base.php');


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

    public function testIndexReplyToUser()
    {
        ob_start();
            v1\MainController::index($this->f3);
        $html = ob_get_contents();
        ob_end_clean();

        $this->assertNotEmpty($html);
    }
}