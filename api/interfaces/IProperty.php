<?php

namespace interfaces;

/**
 * Description of IProperty
 *
 * @author lukasz.martyn
 */
interface IProperty {
	public function set($name, $value);
    public function get($name);
    public function exist($name);
}
