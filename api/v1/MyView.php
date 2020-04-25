<?php
namespace v1;


use View;

class MyView
{

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
    public static $navHtml;

    public static function menu( $PROJECT, $PARAMS )
    {
        ob_start();

        echo View::instance()->render(
            'nav.htm',
            'text/html',
            [
                'menuLinks'=> self::$menuLinks,
                'PROJECT'=>$PROJECT,
                'active'=> $PARAMS
            ] );

        self::$navHtml = ob_get_contents();
        ob_end_clean();
    }
    
    public static function getMenuArray () {
        return self::$menuLinks;
    }
}