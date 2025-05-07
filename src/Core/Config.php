<?php

namespace Kawnix\Core;

class Config
{
    protected static array $config = [];

    public static function load(string $file)
    {
        $path = __DIR__ . '/../../config/' . $file . '.php';

        if (file_exists($path)) {
            self::$config[$file] = require $path;
        }
    }

    public static function get(string $key, $default = null)
    {
        [$file, $item] = explode('.', $key, 2);

        return self::$config[$file][$item] ?? $default;
    }
}
