<?php
namespace v1;
if (defined('CONTROLLER_PAGE') && defined('CONTROLLER_VIEW')) {

    class MainController implements interfaces\ControllerInterface
    {

        private $pageController;
        private $pages;
        private $view;

        /**
         * @param $f3 \Base
         */
        public
        function __construct(\Base $f3)
        {

            $controllerPage = __NAMESPACE__ . '\\' . CONTROLLER_PAGE;
            /** @var MyPageController $controllerPage */
            $this->pages = new $controllerPage ($f3);
            $this->pages->

            /** @var ViewController $viewController */
            $viewController = __NAMESPACE__ . '\\' . CONTROLLER_VIEW;
            $this->view = new $viewController($f3);

        }

        /**
         * @param $f3 \Base
         */
        public function index(\Base $f3)
        {
           echo $this->view->index ( $this->pages );
        }
    }

}