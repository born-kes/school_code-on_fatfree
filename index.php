<?php
require('vendor/autoload.php');

$f3 = Base::instance();
if ((float)PCRE_VERSION<8.0)
	trigger_error('PCRE version is out of date');

// Load configuration
$f3->config('config.ini');

$f3->run();
