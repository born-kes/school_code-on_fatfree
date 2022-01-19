<?php

namespace interfaces;

/**
 * Description of Controller
 *
 * @author lukasz.martyn
 */
interface IController {

 /**
  * IController constructor.
  * @param \Base $f3
  * @param array $PARAMS
  * @param string $router
     */
 public function __construct($f3, $PARAMS = [], $router = '');

 public function response($f3, $PARAMS = [], $router = '');
}
