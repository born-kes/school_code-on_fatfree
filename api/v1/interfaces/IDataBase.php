<?php

namespace v1\interfaces;


interface IDataBase
{
    public static function getInstance($config): IDataBase;

    public function _connect( $options = '') : \DB\SQL;
}