<?php
namespace v1;
use Base;
use v1\interfaces\PageControllerInterface;
use v1\interfaces\PageInterface;
use v1\interfaces\ViewController;

/**
 * Class MainController
 * @package v1
 */
    class MainController implements interfaces\ControllerInterface
    {
        /** @var PageControllerInterface */
        private $pageController;
        /** @var PageInterface */
        private $pages;
        /** @var ViewController */
        private $view;

        /**
         * @param $f3 Base
         */
        public
        function __construct(Base $f3)
        {

            $controllerPage = $f3->get('CONTROLLER_PAGE');
            $this->pageController = new $controllerPage ($f3);

            $viewController = $f3->get('CONTROLLER_VIEW');
            $this->view = new $viewController($f3);

        }

        /**
         * @param $f3 Base
         */
        public function response(Base $f3)
        {
            $this->pages =$this->pageController;
           echo $this->responseView($this->view);
        }

        /**
         * @param \v1\ViewController $viewController
         * @return string
         */
        private function responseView(interfaces\ViewControllerInterface $viewController)
        {
            return $viewController->response( $this->pages );
        }

}