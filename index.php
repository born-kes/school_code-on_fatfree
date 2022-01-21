<?php
require('vendor/autoload.php');

if ((float)PCRE_VERSION < 8.0)
    trigger_error('PCRE version is out of date');

$f3 = ( Base::instance()
    ->config('database.ini')
    ->config('config.ini')
);
$f3->config('routes_v1.ini');
if(	empty($f3->get('ROUTES'))	)
	die('brak routingu');

echo $f3->run();
