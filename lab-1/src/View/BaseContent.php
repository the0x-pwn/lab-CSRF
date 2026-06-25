<?php

namespace Src\View;

class BaseContent
{
    public static function getBaseContent()
    {
        ob_start();
        include view_path() . 'layout/main.php';
        return ob_get_clean();
    }
}
