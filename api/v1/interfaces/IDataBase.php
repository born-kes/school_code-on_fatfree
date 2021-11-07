<?php

namespace v1\interfaces;


interface IDataBase
{
    public static function getInstance($f3): IDataBase;

    public function _connect( $options = '') : \DB\SQL;
}