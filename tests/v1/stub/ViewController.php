<?php


namespace stub;

use Base;
use v1\interfaces\FactoryPageInterface;
use v1\interfaces\ViewControllerInterface;

class ViewController implements ViewControllerInterface
{
    public function response(FactoryPageInterface $pages): string
    {
        return (string) Aggregator::getConfigParam(__METHOD__, $pages);
    }

    public function __construct(Base $f3)
    {
        Aggregator::getConfigParam(__METHOD__, $f3);
    }
}