<?php
use PHPUnit\Framework\TestCase;
use v1\MainController;


class MainControllerNoStaticTest extends TestCase
{

    public function testMockClass ()
    {
        $Ba = $this->createMock(Base::class);
        $Ba->method('get')
            ->willReturn('-masa z Plastiku');

        $w = new MainController();
        $w->index1($Ba);
        
    }

    public function testGetDataFromStaticClass ()
    {

        $class = $this->getMockClass('MyPageController', array('createPageList'));
$this::
        $class::staticExpects($this->any())
            ->method('createPageList')
            ->with($this->equalTo('somevar value'));
        return;
        $this->assertEquals('bar', $class::getPageList());
    }
}