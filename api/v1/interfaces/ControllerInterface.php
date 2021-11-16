<?php

namespace v1\interfaces ;
use \Base;

interface ControllerInterface
{
    public function __construct(Base $f3);
    public function response();
}