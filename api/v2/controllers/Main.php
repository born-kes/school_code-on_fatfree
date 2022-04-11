<?php
declare(strict_types=1 );
namespace v2\controllers;
defined('DIR') or exit;
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
    public function response($f3, $PARAMS = [], $router = ''): string
    {
        $f3 = $this->getABase($f3);
        $f3->set('DIR', DIR );
        $f3->config('api\v2\config_v2.ini');
        $response = '';
        $DataPage = $f3->get('DataPage');
        try {
            /** @var IView $view */
            $view = $this->getView($f3, $DataPage);
            echo $view;
        } catch (\Exception $e) {
            return "{$e->getMessage()}";
        } catch (\Throwable $e) {
            return "{$e->getMessage()}";
        }
        return $response;
    }

    public function getABase($f3)
    {
        return new ABase($f3);
    }

    function getView(IBase $f3, $DataPage = []){
$this->view = new View($f3);
return $this->view->getView();
    }

}
