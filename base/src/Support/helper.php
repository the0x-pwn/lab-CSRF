<?php

use Src\Application\App;
use Src\Headers\Header;
use Src\Http\Request;
use Src\Http\Response;

if (!function_exists('request')) {
    function request(): Request
    {
        return new Request();
    }
}


if (!function_exists('response')) {
    function response(): Response
    {
        return new Response();
    }
}


if (!function_exists('base_path')) {
    function base_path(): string
    {
        return dirname(__DIR__) . '/../';
    }
}

if (!function_exists('view_path')) {
    function view_path(): string
    {
        return base_path() . 'View/';
    }
}


if (!function_exists('headers')) {
    function headers(): Header
    {
        return new Header();
    }
}


if (!function_exists('app')) {
    function app(): App
    {
        static $instance = null;
        if (!$instance) {
            $instance = new App();
        }
        return $instance;
    }
}
