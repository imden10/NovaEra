<?php


namespace App\Response;

trait ResponseTrait
{
    public function errorResponse(array $errors, int $httpCode = 400)
    {
        $data = ['errors' => $errors];

        $data = [
            'success'   => false,
            'http_code' => $httpCode,
            'data'      => $data
        ];

        // Перетворіть дані у JSON
        $json_data = json_encode($data, JSON_UNESCAPED_UNICODE);

        // Задайте HTTP-заголовки для JSON-відповіді
        header('Content-Type: application/json; charset=utf-8');

        // Поверніть JSON-відповідь зі статусом 200
        echo $json_data;
        http_response_code($httpCode);

        exit;
    }

    public function successResponse(array $data, int $httpCode = 200)
    {
        $data = [
            'success'   => true,
            'http_code' => $httpCode,
            'data'      => $data
        ];

        // Перетворіть дані у JSON
        $json_data = json_encode($data, JSON_UNESCAPED_UNICODE);

        // Задайте HTTP-заголовки для JSON-відповіді
        header('Content-Type: application/json; charset=utf-8');

        // Поверніть JSON-відповідь зі статусом 200
        echo $json_data;
        http_response_code($httpCode);

        exit;
    }
}
