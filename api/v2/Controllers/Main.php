<?php

declare(strict_types = 1);

namespace v2\Controllers;

use interfaces\IBase;
use interfaces\IController;
use interfaces\IView;
use v2\adapter\ABase;

class Main implements IController
{
    /** @var \Base */
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

    /**
     * @param \Base $f3
     * @param array $PARAMS
     * @param string $router
     * @return string
     */
    public function response($f3, $PARAMS = [], $router = ''):string
    {
        $f3 = new ABase($f3);
        $response = '';
        $DataPage = $f3->get('DataPage');
        try {
            /** @var IView $view */
            $view = $this->getView($f3, $DataPage);
            $response = $view->get($f3, $DataPage);
        } catch (\Exception $e) {
            return "{$e->getMessage()}";
        } catch (\Throwable $e) {
            return "{$e->getMessage()}";
        }
        return $response;
    }

    function getView(IBase $f3, $DataPage = []): IView
    {
        $className = $f3->get('ViewController');

        if (is_string($className) && class_exists($className)) {
            $viewController = new $className($f3, $DataPage);
        } else if ($className instanceof IView) {
            return $viewController = $className;
        } else {
            throw new \Exception(sprintf('Class Controller "%s" not exists', $className));
        }
        return $viewController;
    }


}