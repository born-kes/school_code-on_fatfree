<?php
namespace v1;
use Base;
use v1\interfaces\FactoryPageInterface;
use v1\interfaces\PageInterface;
use v1\interfaces\ViewController;
use v1\interfaces\ControllerInterface;

/**
 * Class MainController
 * @package v1
 */
    class MainController implements ControllerInterface
    {
        /** @var FactoryPageInterface */
        private $pageController;
        /** @var PageInterface */
        private $pages;
        /** @var ViewController */
        private $view;
        /** @var ControllerDB|ControllerInterface */
        private $db;

        /**
         * @param $f3 Base
         */
        public
        function __construct(Base $f3)
        {
            if ( $db = $f3->get('CONTROLLER_DATABASE') )  {
                if( class_exists($db) ) {
                    try {
                    //    $this->db = $db::response($f3);
                       $this->db = call_user_func_array(array($db, 'response'), [$f3]);
                    } catch (\Exception $e) {
                        self::log( 'Connection error with the data base.' );
                    }
                }
            } else {
                self::log( 'Not found class: '. $f3->get('CONTROLLER_DATABASE') );
            }

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

        public static function log($str)
        {

        }
}