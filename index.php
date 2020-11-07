<?php
require('vendor/autoload.php');

if ((float)PCRE_VERSION<8.0)
	trigger_error('PCRE version is out of date');

echo( Base::instance()
    ->config('config.ini')
    ->run()
);
