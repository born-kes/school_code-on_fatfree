<?php

declare(strict_types=1);

namespace v2\adapter;

use interfaces\IBase;

/**
 * @package v2
 */
class ABase implements IBase
{

    /* @var \Base */
    private $f3;

    public function __construct($f3)
    {
        $this->f3 = $f3;
    }

    public function set($key, $val, $ttl = 0)
    {
        return $this->f3->set($key, $val, $ttl);
    }

    public function read($file, $lf = false): string
    {
        return $this->f3->read($file, $lf);
    }

    public function __call($name, $arg)
    {

        $el = $this->get($name);

        if (!is_null($el) || $el != '') {
            list($fName, $ar, $ar2, $ar3) = $arg;
            if (!is_null($fName)) {
                return $el->$fName($ar, $ar2, $ar3);
            }
            return $el;
        }
    }

    public function get($key, $args = null)
    {
        return $this->f3->get($key, $args);
    }

}
