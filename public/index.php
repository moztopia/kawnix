<?php

// Load dependencies
require_once __DIR__ . '/../vendor/autoload.php';

use Kawnix\Kernel;
use Kawnix\Routing\Route;

// Boot the framework
Kernel::boot();

// Define basic routes
Route::get('/', function () {
    return "Welcome to Kawnix!";
});

Route::get('/info', function () {
    return phpinfo();
});

// Resolve the current request
$response = Route::resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

// Send the response to the browser
echo $response;
