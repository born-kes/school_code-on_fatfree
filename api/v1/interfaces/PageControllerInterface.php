<?php
namespace v1\interfaces;


interface PageControllerInterface
{
    static
    function getClassForCurrentPage($ActivePage);

    static
    function getPageList();
}