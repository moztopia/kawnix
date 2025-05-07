<?php

namespace App\Controllers;

abstract class Controller
{
    // Common method for sending JSON responses
    protected function json(array $data, int $statusCode = 200)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);

        exit;
    }
}
