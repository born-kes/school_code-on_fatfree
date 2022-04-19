<?php


namespace v1;


use v1\interfaces\FactoryPageInterface;
use v1\interfaces\ViewControllerInterface;

class ViewController implements ViewControllerInterface
{
    /**
     * @var \Base
     */
    private $f3;

    /**
     * ViewController constructor.
     * @param \Base $f3
     */
    public function __construct(\Base $f3)
    {
        $this->f3 = $f3;
    }

    /**
     * @param FactoryPageInterface $pages
     * @return string
     */
    public function response(FactoryPageInterface $pages) : string
    {
        $this->f3->set('navHtml', 'nav.html');
        $this->f3->set('menuLinks', array_merge($pages->getPageList(),[]));
        $this->f3->set('content', $pages->getContentFromControllerClass() );

        return \Template::instance()->render("layout.html");

    }
}