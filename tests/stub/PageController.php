<?php
namespace stub;

use v1\interfaces\PageControllerInterface;

class PageController implements PageControllerInterface
{
    /**
     * @return array
     */
    function getPageList()
    {
        return Aggregator::getConfigParam(__METHOD__);
    }

    /**
     * @param $f3 \Base
     */
    public function __construct(\Base $f3)
    {
        return Aggregator::getConfigParam(__METHOD__, $f3);
    }

    /**
     * @return string ClassName PageInterface
     */
    function getContentFromControllerClass()
    {
        return Aggregator::getConfigParam(__METHOD__);
    }
}