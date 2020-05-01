<?php
namespace v1;

class Error {

    public static function index ( $f3 )
    {
        while (ob_get_level())
            ob_end_clean();
        echo $f3->get('ERROR.text');
    }
}