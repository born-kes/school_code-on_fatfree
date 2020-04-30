<?php
namespace v1;

class MainController {

    /**
     * @param $f3 \Base
     */
    static function index ($f3) {
        // todo Session test
            // user Login & login in
            // login Out & testTime

        //ToDo Get this Page
            // whot to do when is empty or does not exist
//        MyPageController::setPage($f3->get('PAGES.0'));
        $f3->set('menuLinks', MyPageController::getPageList ( $f3 ) );

        // action User - Post/Put/Delete
        $classPage = MyPageController::getClassForCurrentPage ($f3->get('PARAMS.0'));
		ob_start();
		$content = call_user_func(__NAMESPACE__."\\{$classPage}::index", $f3 );
		
        $f3->set('content', $content?$content:ob_get_contents() );
			ob_end_clean();
        // get User data
        // get Page data

        // Response type
            // ajax, csv, html
        self::replyToUser ($f3);
    }

    /**
     * @param $f3 \Base
     */
    static function template ( $f3 ) {

        if ( class_exists( $f3 -> get ('PARAMS.page') ) ) {
            $f3->set('content',
                call_user_func(__NAMESPACE__."\\{$f3->get('PARAMS.page')}::index", $f3 )
            );
        }

    }

    private static function replyToUser(\Base $f3)
    {
        $f3->set('navHtml', '/nav.html' );
        $f3->set('menuLinks', MyPageController::getPageList() );

        echo \Template::instance()->render("layout.html");
    }
} 