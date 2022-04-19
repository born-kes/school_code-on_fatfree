<?php
declare(strict_types = 1);

namespace interfaces;

interface IController {

 /**
  * IController constructor.
  * @param \Base $f3
  * @param array $PARAMS
  * @param string $router
     */
 public function __construct($f3, $PARAMS = [], $router = '');

 public function response($f3, $PARAMS = [], $router = ''): string;
}
