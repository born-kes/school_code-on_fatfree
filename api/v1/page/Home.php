<?php
namespace v1\Page;

use v1\interfaces\PageInterface;

class Home implements PageInterface
{
    /**
     * @var \Base
     */
    private $f3;

    /**
     * @param $f3 \Base
     * @return string|callable|void
     */
    function index ()
    {
        echo 'Hello';
    }

    /**
     * Home constructor.
     * @param \Base $f3
     */
    public function __construct(\Base $f3)
    {
        $this->f3 = $f3;
    }
}