<?php
namespace v1\Page;

use v1\interfaces\PageInterface;

class Generator implements PageInterface
{
    /**
     * @var \Base
     */
    private $f3;
    private $listGenerator = [
        ['url'=>"1", 'text'=>'Generowanie nowej Class - projekt 1 - oparty o "contenteditable"'],
        ['url'=>"2", 'text'=>'Generowanie nowej Class - projekt 2 - oparty o inputy'],
        ['url'=>"CodeMirror", 'text'=>'Edytor oparty o CodeMirror'],
    ];

    /**
     * @param $f3 \Base
     * @return string|callable
     */
    public function index ()
    {

        /**
         * verification user request
         */
        $this->validatePost();
        /**
         * selected editor by the user
         */
        return $this->returnPage(
            $this->f3->get('PARAMS.command')
        );
    }

    private function returnPage(string $command = null)
    {
        switch ( $command ):
            case $this->listGenerator[0]['url']:
                return function (){ return \Template::instance()->render('generator1.html' ); };
            case $this->listGenerator[1]['url']:
                return function() { return \Template::instance()->render('generator2.html'); };
                break;
            case $this->listGenerator[2]['url']:
                return
                    function() {
                        $data = [
                            'CodeMirror' => 'vendor/npm-asset/codemirror',
                            'js' => [
                                'vendor/npm-asset/codemirror/addon/hint/show-hint',
                                'vendor/npm-asset/codemirror/addon/display/fullscreen',
                            ],
                            'css' => [
                                'vendor/npm-asset/codemirror/addon/hint/show-hint',
                                'vendor/npm-asset/codemirror/addon/display/fullscreen',
                            ],
                            'CodeMirrorOptions' => [
                                'mode.extraKeys["Ctrl-Space"] = "autocomplete";
                                mode.hintOptions = {hint: synonyms};',
                                'mode.extraKeys["F11"] = function(cm) {cm.setOption("fullScreen", !cm.getOption("fullScreen"));};',
                                'mode.extraKeys["Esc"] = function(cm) {if(cm.getOption("fullScreen"))cm.setOption("fullScreen", false);};',

                            ]
                        ];

                        return \Template::instance()->render('generator3.html',null, $data);
                    };
                break;
            default:
        return
            function() {
                $BASE = $this->f3->get('BASE');
                $PARAMS=  $this->f3->get('PARAMS.page');
                $list = [];

                foreach ($this->listGenerator as $row )
                    $list[] = ['url'=>"{$BASE}/{$PARAMS}/{$row['url']}", 'text'=> $row['text'] ] ;

            $data = ['menuLinks'=>
                $list
            ];

           return \Template::instance()->render('generator.html', null, $data );
        };
        endswitch;
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