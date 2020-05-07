<?php

namespace v1;

use stub\Aggregator;
use \v1\interfaces\PageInterface;

class Page implements PageInterface
{
    /**
     * Use MainController line::27
     * @param \Base $f3
     * @return mixed|string
     */
    static
    function index( \Base $f3 )
    {
        return Aggregator::getConfigParam(__METHOD__);
    }
}