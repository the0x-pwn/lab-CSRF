<?php

namespace Src\Http;

class Response
{

    public function responseJSON(?string $message, int $code = 301)
    {
        http_response_code($code);
        header("Content-Type: Application/json");
        echo json_encode([
            'status' => $code,
            'method' => request()->method(),
            'path' => request()->path(),
            'message' => $message,
        ]);
        exit;
    }


    public function back()
    {
        $referer = $_SERVER['HTTP_REFERER'];

        if (!$referer) {
            return $this->responseJSON('not found referer', 404);
        }

        $host = parse_url($referer, PHP_URL_HOST);

        if ($host !== $_SERVER['HTTP_HOST']) {
            return $this->responseJSON('invalid referer', 403);
        }

        header("Location: $referer");
        exit;
    }

    public function redirect(string $path)
    {
        header("Location: " . $path);
        exit;
    }
}
