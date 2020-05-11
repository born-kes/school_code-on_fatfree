<?php

namespace stub;


class Aggregator
{
    /**
     * This variable has data returned if it invokes the appropriate class
     * @var array
     */
    private static $config = [];
    /**
     *  This variable has data who call to aggregator
     *
     * @var array
     */
    private static $call = [];

    /**
     * Have data to returned if first you implement by SetConfigByTests
     *
     * @param $_method_
     * @param null $arg
     * @return mixed|null
     */
    public static function getConfigParam (string $_method_, $arg = null )
    {

        self::$call[] = "{$_method_}" . (is_Null($arg)?'':" => ".self::toString($arg) );

        if ( isset (self::$config[$_method_]) ){
            return self::$config[$_method_];
        }else{
            return null;
        }
    }


    /**
     * Sets Config returned by getConfigParam
     *
     * @param array $args
     */
    public static function setConfigByTests (array $args )
    {
        self::$config = $args;
    }

    /**
     * Returns who is calling the aggregator, or who is calling the next one
     *
     * @param Integer|null $id
     * @return array|mixed|null
     */
    public static function getAggregatorCallByTest(int $id = null)
    {
        if (is_null($id))
            return self::$call;
        if ($id > count (self::$call)-1 )
            return null;
        return self::$call[$id];

    }

    private function __construct( )
    {}

    /**
     * Clearing Config and Call list
     */
    public static function unsetAggregator()
    {
        self::$config = self::$call = [];
    }

    /**
     * convert value to strong
     *
     * @param mixed $value
     * @return string
     */
    public static function toString($value) :string
    {
        switch(true) {
            case is_numeric($value) :
            case is_string($value) :
                return $value;
                break;
            case $value instanceof Closure:
                return "function";
                break;
            case is_callable($value):
                return "function";
                break;
            case $value instanceof \Base:
                return "Base";
                break;
            case is_object($value):
                return get_class($value);
                break;
            case is_array($value):
            case is_bool($value):
                ob_start();
                print_r($value);
                $string = ob_get_contents();
                ob_end_clean();
                return $string;
                break;
        }
        return  gettype ($value);
    }
}