<?php
namespace v1;

use View;

class main {

    /**
     * @param $f3
     */
    static function index ($f3) {

        /*
        // Session test
            // user Login
            // login Out & testTime

        //Get this Page
            // whot to do when is empty or does not exist

        // action User - Post/Put/Delete
            

        // get User data
        // get Page data

        // Response type
            // ajax, csv, html
        //*/

//    self::view( $f3 );
    self::template( $f3 );
    }

    static function view ( $f3 ) {
        MyView::menu( $f3->get('PROJECT'),  $f3->get('PARAMS.0') );

        echo View::instance()->render('layout.htm');
    }

    static function template ( $f3 ) {

        $f3->set('navHtml', '/nav.html' );
        $f3->set('menuLinks', MyView::getMenuArray() );

//        if (class_exists($f3->get('PARAMS.page')) && method_exists(__NAMESPACE__."\\{$f3->get('PARAMS.page')}", 'index') ) {
//            call_user_func(__NAMESPACE__."\\{$f3->get('PARAMS.page')}::index",$f3);
//
//        }

        echo \Template::instance()->render("layout.html");
    }
} 