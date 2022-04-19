<?php
declare(strict_types = 1);
namespace interfaces;

/**
 * Description of IBase
 *
 * @author lukasz.martyn
 */
interface IBase
{

    /**
     * 	Retrieve contents of hive key
     * 	@return mixed
     * 	@param $key string
     * 	@param $args string|array
     * */
    public function get($key, $args = NULL);

    /**
     * 	Bind value to hive key
     * 	@return mixed
     * 	@param $key string
     * 	@param $val mixed
     * 	@param $ttl int
     * */
    public function set($key, $val, $ttl = 0);

    /**
     * 	Read file (with option to apply Unix LF as standard line ending)
     * 	@return string
     * 	@param $file string
     * 	@param $lf bool
     * */
    public function read($file, $lf = FALSE);

    public function config($source, $allow = FALSE);
}
