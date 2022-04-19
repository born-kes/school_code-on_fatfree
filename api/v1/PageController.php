<?php
namespace v1;

use Base;
use v1\interfaces\PageControllerInterface;

class PageController implements PageControllerInterface
{
    private $DefaultClassForCurrentPage = 'Home';
    private $menuLinks = [
        [
            'text' => 'Archiwum',
            'url' => [
                [
                    'text' => 'Archiwum My Code',
                    'url' => 'Archiwum',
                ],
                [
                    'text' => 'Function',
                    'url' => 'Function'
                ],
                [
                    'class' => 'Lib',
                    'text' => 'Library',
                    'url' => 'lib'
                ],
            ]
        ],
        [
            'class' => 'Generator',
            'text' => 'Code Generator',
            'url' => 'Generator'
        ],
        [
            'text' => 'ftp',
            'url' => 'ftp'
        ],
        [
            'text' => 'Blog',
            'url' => 'Blog'
        ]
    ];
    private $navArray = null;
    private $f3;
    private $pageController;


    /**
     * @param $f3 Base
     */
    public
    function __construct(Base $f3)
    {
        $this->f3 = $f3;

        $this->pageController = $this->getClassForCurrentPage();
    }

    /**
     * @return array|null
     */
    public
    function getPageList() :array
    {
        if ($this->navArray == null) {
            $this->navArray = $this->createPageList ($this->menuLinks);
        }
        return $this->navArray;
    }

    /**
     * @param $menuLinks
     * @return array
     */
    private
    function createPageList (array $menuLinks = []) : array
    {
        $pageList = [];
        foreach ($menuLinks as $name => $value) {

            $text = $value['text'];
            /** @var array $value */
            $url = is_array($value['url'])? $this->createPageList ($value['url']): $value['url'];

            $pageList[$name] = [
                'text' => $text,
                'url' => $url
            ];
        }

        return $pageList;
    }

    /**
     * @return class v1\interfaces\PageInterface
     */
    private
    function getClassForCurrentPage()
    {
        $lista = $this->menuLinks;
        $ActivePage = $this->f3->get('PARAMS.0');
        $accessPath = explode('/', $ActivePage);

        foreach ($accessPath as $key) {
            foreach ($lista as $value) {
                if(!is_array($value)) break;
                if($value['url'] == $key ) {
                    $lista = $value;
                    break;
                } else if( is_array($value['url']) && $value['text'] == $key ) {
                    $lista = $value['url'];
                    break;
                }
            }
        }
        if( isset($lista['class']) ) {
            return $this->checkingClassController ($lista['class']);
        }
        return $this->checkingClassController ( $this->DefaultClassForCurrentPage );
    }

    /**
     * @param $NameClass
     * @return class v1\interfaces\PageInterface
     */
    private
    function checkingClassController ($NameClass)
    {
        $namespacePage = $this->f3->get('NAMESPACE_PAGE');
        $pathClass = "{$namespacePage}\\{$NameClass}";

        if(!class_exists($pathClass) || !in_array("\\interfaces\\PageInterface", class_implements($pathClass))) {
            $pathClass = "{$namespacePage}\\{$this->DefaultClassForCurrentPage}";
        }
        return new $pathClass($this->f3) ;
    }

    /**
     * @return string|callable|void
     */
    public
    function getContentFromControllerClass()
    {
        ob_start();
        $content = $this->pageController->index();

        $content = $content ? $content : ob_get_contents();
        ob_end_clean();

        return $content;
    }
}