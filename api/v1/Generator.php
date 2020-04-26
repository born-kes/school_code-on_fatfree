<?php
namespace v1;

use Template;

class Generator
{

    /**
     * @param $f3 \Base
     * @return void
     */
    public static function index ($f3)
    {
        var_dump( $f3->get('POST') );

        self::validatePost( $f3 );
        return function() {
           return Template::instance()->render('generator.html');
        };
    }

    public static function validatePost ($f3) {

        if ( empty($f3->get('POST.newClassTest')) || empty($f3->get('POST.file')) )
            return;

        $file = 'src/' . $f3->get('POST.newClassTest') ;
        $data = implode("\n",array_map("trim", explode("\n", $f3->get('POST.file')) ) );

        if (! file_exists("{$file}.php") ) {

            $f3->write("{$file}.php", $data);
        } else {

            $time = time();
            $f3->write("{$file}{$time}.php", $data);
        }

    }
}