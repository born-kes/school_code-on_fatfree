<?php

namespace interfaces;

/**
 * Description of IPage
 *
 * @author lukasz.martyn
 */
interface IPage {

 public function __construct(string $url, string $text, string $title, array $access, $content = [], $responsibleClass = '');

 public function getData($f3);

 public function getContent($key);
}
