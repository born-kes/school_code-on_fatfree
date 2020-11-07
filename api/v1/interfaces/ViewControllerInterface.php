<?php

namespace v1\interfaces ;

interface ViewControllerInterface
{
    public function response(FactoryPageInterface $pages) : string;
}