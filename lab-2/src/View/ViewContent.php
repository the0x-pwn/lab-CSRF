<?php

namespace Src\View;

class ViewContent
{
    public static function getViewContent(string $view, bool $isError = false, array $data = [])
    {
        $path = $isError ? view_path() . 'error/' : view_path();

        if (str_contains($view, '.')) {
            $views = explode('.', $view);
            foreach ($views as $view) {
                if (is_dir($path . $view)) {
                    $path = $path . $view . '/';
                }
                $view = $path . end($views) . '.php';
            }
        } else {
            $view = $path . $view . '.php';
        }

        extract($data);

        if ($isError) {
            include $view;
        } else {
            ob_start();
            include $view;
            return ob_get_clean();
        }
    }
}
