<?php
require('vendor/autoload.php');

if ((float)PCRE_VERSION < 8.0)
    trigger_error('PCRE version is out of date');
try {
	function t($string){ return $string; }

$f3 = ( Base::instance()
    ->config('database.ini')
    ->config('config.ini')
);
$f3->config('routes_v1.ini');
if(	empty($f3->get('ROUTES'))	)
	die('brak routingu');

echo $f3->run();
die;
} catch (EngineException $e) {
    $messageError = $e ;
} catch (ParseError $e) {
    $messageError = $e ;
} catch (TypeError $e) {
    $messageError = $e ;
} catch (\Throwable $e) {
    $messageError = $e ;
} catch (\Exception $e) {
    $messageError = $e->getMessage() ;
}
include( 'ui/404.html.php');
