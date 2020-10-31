<?php

namespace v1\interfaces ;

interface ViewControllerInterface
{
    public function response(PageControllerInterface $pages) : string;
}