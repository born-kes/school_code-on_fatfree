<?php


use PHPUnit\Framework\TestCase;
use stub\Aggregator;
use stub\Page;

class PageTest extends TestCase
{

    /**
     * Test Page implements interface \v1\interfaces\PageInterface
     */
    public function testPageImplementsInterface ()
    {
        $page = new Page(\Base::instance());
        $this->assertInstanceOf('\v1\interfaces\PageInterface', $page);
    }

    /**
     * Testing return Page->index()
     */
    public function testPageIndexReturnsDataFromTheAggregatorSet ()
    {
        /**
         * Sets Config by Stub Page
         */
        Aggregator::setConfigByTests([
            'stub\Page::index' => 'test data Value'
        ]);

        $page = new Page(\Base::instance());
        $this->assertEquals('test data Value', $page->index() );
    }
}