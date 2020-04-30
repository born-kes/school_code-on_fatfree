<?php
namespace v1;

class MyPageController
{
    private static $DefaultClassForCurrentPage = 'Home';
    private static $menuLinks = [
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
    private static $navArray = null;

    public static function getPageList()
    {
        if (self::$navArray == null) {
            self::$navArray = self::createPageList (self::$menuLinks);
        }
        return self::$navArray;
    }

    private static function createPageList ($menuLinks)
    {
        $pageList = [];
        foreach ($menuLinks as $name => $value) {

            $text = $value['text'];
             $url = is_array($value['url'])? self::createPageList ($value['url']):$value['url'];

            $pageList[$name] = [
                'text' => $text,
                'url' => $url
            ];
        }

        return $pageList;
    }

    public static function getClassForCurrentPage($ActivePage)
    {
        $lista = self::$menuLinks;
        $accessPath = explode('/', $ActivePage);

        foreach ($accessPath as $key) {
            if($key == '') continue;
            foreach ($lista as $value){
                if(!is_array($value)) break;
                if($value['url'] == $key ) {
                    $lista = $value;
                    break;
                }else if( is_array($value['url']) && $value['text'] == $key ){
                    $lista = $value['url'];
                }
            }
        }
        if( isset($lista['class']) ){
            return $lista['class'];
        }
        return self::$DefaultClassForCurrentPage;
    }
}