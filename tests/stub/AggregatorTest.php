<?php

use PHPUnit\Framework\TestCase;
use stub\Aggregator;


class AggregatorTest extends TestCase
{

    public function testUnsetAggregator()
    {
        /** clearing entries */
        Aggregator::unsetAggregator();
        $this->assertIsArray( Aggregator::getAggregatorCallByTest() );
    }
    /**
     * testing ::getAggregatorCallByTest() and ::getConfigParam()
     */
    public function testGetAggregatorCallByTest()
    {
        /** clearing entries */
        Aggregator::unsetAggregator();

        $this->assertEquals([], Aggregator::getAggregatorCallByTest() );
        $this->assertEquals(null, Aggregator::getAggregatorCallByTest(0) );

        /** new entry id[0] from the connection standard */
        Aggregator::getConfigParam(__METHOD__);
        /** Test add entry */
        $this->assertEquals(1, count(Aggregator::getAggregatorCallByTest()) );
        $this->assertEquals("AggregatorTest::testGetAggregatorCallByTest",
            Aggregator::getAggregatorCallByTest(0) );

        /**
         * clearing entries
         *
         *  Test Alternative add
         */
        Aggregator::unsetAggregator();

        /** new entry id[0] and return from config */
        $this->assertEquals(null, Aggregator::getConfigParam('class', 'test') );
        /** Test add entry id[0] */
        $this->assertEquals(["class => test"], Aggregator::getAggregatorCallByTest() );
    }

    /**
     * Testing use setConfigByTests and getConfigParam
     */
    public function testSetConfigByTestsAndGetConfigParam()
    {
        /** clearing entries */
        Aggregator::unsetAggregator();

        Aggregator::setConfigByTests([
            'class' => 'Page',
            'class1' =>[]
        ]) ;

        /** new entry id[0] and reply */
        $this->assertEquals('Page', Aggregator::getConfigParam('class', 'test') );

        /**   entry id[1] and reply */
        $this->assertEquals([], Aggregator::getConfigParam('class1') );

        /** Test add entry id[1] */
        $this->assertEquals("class1", Aggregator::getAggregatorCallByTest(1) );

    }
}