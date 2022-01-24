<?php

declare(strict_types = 1);

namespace v2\Controllers;

use interfaces\IController;

class Main implements IController
{
    private $f3;
    private $params;
    private $router;

    /**
     * IController constructor.
     * @param \Base $f3
     * @param array $PARAMS
     * @param string $router
     */
    public function __construct($f3, $PARAMS = [], $router = '')
    {
        $this->f3 = $f3;
        $this->params = $PARAMS;
        $this->router = $router;
    }

    public function response($f3, $PARAMS = [], $router = '')
    {
    }
}