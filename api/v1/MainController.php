<?php
namespace v1;

    class MainController implements interfaces\ControllerInterface
    {

        private $pageController;
        /** @var \v1\MyPageController */
        private $pages;
        /** @var \v1\ViewController */
        private $view;

        /**
         * @param $f3 \Base
         */
        public
        function __construct(\Base $f3)
        {

            $controllerPage = $f3->get('CONTROLLER_PAGE');
            $this->pages = new $controllerPage ($f3);

            $viewController = $f3->get('CONTROLLER_VIEW');
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