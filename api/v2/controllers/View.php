<?php
declare(strict_types=1);
namespace v2\controllers;

use \interfaces\IBase;
use \interfaces\IView;

class View
{

    private $f3;
    private $view;

    function getView(): IView
    {
        return $this->view;
    }

    public function __construct(IBase $f3)
    {
        $this->f3 = $f3;
        $this->view = $this->getControllerView();
    }

    private function getControllerView()
    {
        $className = $this->f3->get('ViewController');

        if (is_string($className) && class_exists($className)) {
            $viewController = new $className($this->f3);
        }
        else if ($className instanceof IView) {
            return $viewController = $className;
        }
        else {
            throw new \Exception(sprintf('Class Controller "%s" not exists', $className));
        }
        return $viewController;
    }

}
