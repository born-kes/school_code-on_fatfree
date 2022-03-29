<?php
declare(strict_types=1);
namespace v2\interfaces\IGetContents;

interface IGetContents
{

    public function read($file, $lf = FALSE): string;

    public function get($key, $args = null);
}
