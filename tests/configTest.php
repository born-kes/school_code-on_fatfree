<?php


use PHPUnit\Framework\TestCase;

class configTest extends TestCase
{
    /**
     * @var \Base
     */
    private $f3;


    function setUp(): void
    {
        $this->f3 = \Base::instance();
        $this->f3->set('QUIET', TRUE);
        $this->f3->config('config.ini')->config('routes_v1.ini');

    }

    function testValidateConfig()
    {
        $this->assertNotTrue(empty($this->f3->get('ROUTES')), 'Route is NOT empty');
        $this->assertNotNull($this->f3->get('ROUTES'), 'Routes is NOT NULL');
        $this->assertTrue(is_array($this->f3->get('ROUTES')), 'Router is not array');
    }
}

