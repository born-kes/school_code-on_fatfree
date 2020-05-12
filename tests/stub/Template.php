<?php
namespace stub;

use stub\Aggregator;

class Template
{
    static function instance(){
        return new \Template();
    }

    function render($string) : string
    {
        return Aggregator::getConfigParam(__METHOD__,  $string);

    }
}