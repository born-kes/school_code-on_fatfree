<?php
declare(strict_types=1);
namespace v2\ValueObject;

use \v2\interfaces\IGetContents;
use \v2\method\CombineString;
class Template
{

    private $f3;
    private $template;
    private $toolsString;

    public function __toString()
    {
        return $this->response([false]);
    }

    public function response(array $array)
    {
        return  $this->toolsString->replace($this->template, $array );
    }

    public function __construct(IGetContents $f3, string $nameFile, $toolsString = '')
    {
        $this->path = $f3->get('UI');
        $this->nameFile = $nameFile;
        $this->toolsString = $this->getTools($toolsString);
        $this->template = $this->getTemplate($f3, $template);
    }

    private function getTemplate($f3, $file)
    {
        $pathTemplate = $this->path . DIRECTORY_SEPARATOR . $file;
        if (file_exists($pathTemplate)) {
            return $f3->read($pathTemplate);
        }
        throw new Exception(\t('Error: 500 not found file temlpate "%s"', $file));
    }

    private function getTools($toolsString)
    {
        if($toolsString =='')
            return CombineString::instance();
            return $toolsString;
    }

}
