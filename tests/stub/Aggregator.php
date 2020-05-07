<?php

namespace stub;


 class Aggregator
{
     /**
      * @var Class
      */
    private static $Class;
     /**
      * @var array
      */
    private static $config = [];
     /**
      * @var array
      */
     private static $call = [];

     public static function getConfigParam ( $method, $arg=null )
    {
      var_dump( self::$call[] = [$method, $arg ] );

        if ( isset (self::$config[$method]) ){
            return self::$config[$method];
        }else{
            return 'null';
        }
    }

     public static function setConfigByTests ( $args )
     {
         self::$config = $args;
     }

     public static function getAggregatorCallByTest()
     {
         return self::$call;
     }

     private function __construct( )
     {}

     public static function unsetAggregatro()
     {
         self::$config = self::$call = [];
     }
 }