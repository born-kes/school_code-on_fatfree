<?php
namespace v1\Page;

use v1\interfaces\PageInterface;

class Generator implements PageInterface
{
    /**
     * @var \Base
     */
    private $f3;

    /**
     * @param $f3 \Base
     * @return string|callable
     */
    public function index ()
    {

        $this->validatePost();
        return
            function() {
           return \Template::instance()->render('generator.html');
        };
    }

    /**
     * write file test
     */
    private function validatePost () {

        if ( empty($this->f3->get('POST.newClassTest')) || empty($this->f3->get('POST.file')) )
            return;

        $file = 'src/' . $this->f3->get('POST.newClassTest') ;
        $data = implode("\n",array_map("trim", explode("\n", $this->f3->get('POST.file')) ) );

        if (! file_exists("{$file}.php") ) {

            $this->f3->write("{$file}.php", $data);
        } else {

            $time = time();
            $this->f3->write("{$file}{$time}.php", $data);
        }

    }


    /**
     * Generator constructor.
     * @param \Base $f3
     */
    public function __construct(\Base $f3)
    {
        $this->f3 = $f3;
    }
}