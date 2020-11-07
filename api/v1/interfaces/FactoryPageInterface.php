<?php
namespace v1\interfaces;


interface FactoryPageInterface
{

    /**
     * @param $f3 \Base
     */
    function __construct(\Base $f3);

    function getContentFromControllerClass();

    function getPageList();
}