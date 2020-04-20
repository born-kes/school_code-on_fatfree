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


        MyView::setMenu( ['jeden');



		$f3->set('content','main\test.htm');

        $f3->set('test1','world');
		echo View::instance()->render('layout.htm');
    }
} 