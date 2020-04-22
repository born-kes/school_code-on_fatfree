<?php
namespace v1;

use View;

class main {

    static function index ($f3) {

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


        MyView::menu( $f3->get('PROJECT'),  $f3->get('PARAMS.0') );

		echo View::instance()->render('layout.htm');
    }
} 