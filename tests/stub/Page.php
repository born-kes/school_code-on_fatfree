<?php

namespace stub;

use stub\Aggregator;
use \v1\interfaces\PageInterface;

class Page implements PageInterface
{
    /**
     * @return mixed|string
     */
    function index()
    {
        return Aggregator::getConfigParam(__METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function __construct(\Base $f3)
    {
        Aggregator::getConfigParam(__METHOD__, $f3);
    }
}
class Home extends Page {
    function index()
    {
        return Aggregator::getConfigParam(__METHOD__);
    }
}
class Generator extends Page {
    function index()
    {
        return Aggregator::getConfigParam(__METHOD__);
    }
}
class Lib {}