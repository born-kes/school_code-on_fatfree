<?php
declare(strict_types=1);
namespace v2\ValueObject;

use \v2\interfaces\IGetContents;
//use \v2\method\CombineString;

class Template implements \interfaces\IView
{

    private $f3;
    private $template;
    private $toolsString;
    private $templateFile;

    public function __toString()
    {
        return $this->template;
    }

    public function response(array $array)
    {
        return $this->toolsString->replace($this->template, $array);
    }

    public function __construct(IGetContents $f3, string $templateFile = 'layout.html', $toolsString = '')
    {
        $this->path = $f3->get('DIR') . $f3->get('UI');
        $this->templateFile = $templateFile;
        $this->toolsString = $this->getTools($toolsString);
        $this->template = $this->getTemplate($f3, $templateFile);
    }

    private function getTemplate($f3, $file)
    {
        $pathTemplate = $this->path . $file;
        if (file_exists($pathTemplate)) {
            return $f3->read($pathTemplate);
        }
        throw new \Exception(\t('Error: 500 not found file temlpate "%s"', $pathTemplate));
    }

    private function getTools($toolsString)
    {
        if ($toolsString == '')
        //      return CombineString::instance();
            return $toolsString;
    }

    public function get(\interfaces\IBase $f3, $DataPage): string
    {
        return 'null';
    }

}
