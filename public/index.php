<?php

require_once __DIR__ . '/vendor/autoload.php';

use Kawnix\Routing\Route;

Route::get('/test', function () {
    return "Kawnix routing works!";
});

echo Route::resolve('GET', '/test');
