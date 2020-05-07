<?php
namespace v1;

use stub\Aggregator;
use \v1\interfaces\PageControllerInterface;

class MyPageController implements PageControllerInterface
{
    /**
     * Use MainController line::22
     * @return array
     */
    static
    function getPageList()
    {
        return Aggregator::getConfigParam(__METHOD__);

    }

    /** Use MainController line::25
     * @param $ActivePage
     * @return string ClassName PageInterface
     */
    static
    function getClassForCurrentPage($ActivePage)
    {
echo __METHOD__;
        return Aggregator::getConfigParam(__METHOD__, $ActivePage);

    }
}