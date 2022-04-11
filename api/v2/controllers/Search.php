<?php
declare(strict_types = 1);
namespace v2\controllers;

use interfaces\IController;

class Search implements IController
{

    /**
     * Search constructor.
     * @param \Base $f3
     * @param array $params
     * @param string $router
     */
    public function __construct($f3, $params = [], $router = '')
    {
    }

    public function response($f3, $PARAMS = [], $router = ''): string
    {
        $response = $f3->get('search')?$f3->get('search'):'input';
        return $response;
    }
}
