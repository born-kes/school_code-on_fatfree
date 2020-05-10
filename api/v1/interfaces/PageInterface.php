<?php


namespace v1\interfaces;


interface PageInterface
{

    /**
     * @param $f3 \Base
     */
    function __construct (\Base $f3);

    /**
     * @return string|callable|void
     */
    function index ();
}