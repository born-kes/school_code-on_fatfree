<?php

use PHPUnit\Framework\TestCase;
use stub\Aggregator;


class AggregatorTest extends TestCase
{

    protected function setUp(): void
    {
        Aggregator::clineDataAggregator();
    }

    /**
     * @test
     */
    public function retrieveAggregatorCallData()
    {
        # Arrange / Given

        # Act / When
        /** add entry */
        Aggregator::getConfigParam(__METHOD__);

        #Assert / That
        $this->assertEquals(1, count(Aggregator::retrieveAggregatorCallData()));
        $this->assertEquals(__METHOD__, Aggregator::retrieveAggregatorCallData(0));

    }

    /**
     * @test
     */
    public function addSecretiveDataCallAggregator ()
    {
        # Arrange / Given

        # Act / When
        Aggregator::getConfigParam('class::method', 'test');

        #Assert / That
        $this->assertEquals(["class::method => test"], Aggregator::retrieveAggregatorCallData() );
    }

    /**
     * @afterClass addSecretiveDataCallAggregator
     * @test
     */
    public function cleanVerificationByNextTest ()
    {   # Assert / Then
        $this->assertEquals([], Aggregator::retrieveAggregatorCallData(), 'Aggregator is not null');
    }

    /**
     * @test
     */
    public function setConfigParamsAndGetConfigParam()
    {
        # Arrange / Given
        $className = ['firstClass', 'secondNameClass'];
        $expected = [
            $className[0] => 'Page',
            $className[1] => [1, 2, 3]
        ];

        # Act / When
        Aggregator::setConfigParams($expected);

        #Assert / That
        $this->assertEquals($expected[$className[0]], Aggregator::getConfigParam($className[0], 'test'));
        $this->assertEquals($expected[$className[1]], Aggregator::getConfigParam($className[1]));

        return $className;
    }

    /**
     * @test
     * @depends setConfigParamsAndGetConfigParam
     *
     */
    public function aggregatorShouldRememberHowGetConfigParams($className)
    {
        # Arrange / Given
        $expected = [
            $className[0] => 'not relevant 1',
            $className[1] => 'not relevant 2'

        ];
        Aggregator::setConfigParams($expected);

        # Act / When
        Aggregator::getConfigParam($className[0]);
        Aggregator::getConfigParam($className[1]);

        #Assert / That
        $this->assertEquals( $className[1], Aggregator::retrieveAggregatorCallData(1) );

    }

    public function testToString ()
    {
        $this->assertEquals('string', Aggregator::toString('string') );
        $this->assertEquals('11.5', Aggregator::toString(11.5) );
        $this->assertNotEquals('12', Aggregator::toString(11.9) );

        $answerArray = "Array\n(\n)\n";
        $this->assertEquals($answerArray, Aggregator::toString([]) );
        $this->assertEquals('Base', Aggregator::toString(\Base::instance()) );
        $this->assertEquals('function', Aggregator::toString(function(){} ) );

    }
}