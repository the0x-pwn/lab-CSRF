<?php

namespace Src\View;

use Src\View\BaseContent;
use Src\View\ViewContent;

class View
{
    public static function make(string $view, array $data = [])
    {
        $getViewContent = ViewContent::getViewContent($view, data: $data);
        $getBaseContent = BaseContent::getBaseContent();
        echo str_replace('{{content}}', $getViewContent, $getBaseContent);
    }
}
