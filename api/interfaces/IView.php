<?php

namespace interfaces;
use \interfaces\IBase;
/**
 * Description of IView
 *
 * @author lukasz.martyn
 */
interface IView {

public function get(IBase $f3, $DataPage):string;

}
