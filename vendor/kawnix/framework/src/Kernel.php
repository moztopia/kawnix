<?php

namespace Kawnix;

class Kernel
{
    protected static array $services = [];

    public static function boot(): void
    {
        self::loadEnvironment();
        self::registerServices();
        echo "✅ Kawnix framework booted successfully!\n";
    }

    protected static function loadEnvironment(): void
    {
        if (file_exists(__DIR__ . '/../config/env.php')) {
            require_once __DIR__ . '/../config/env.php';
        }
    }

    protected static function registerServices(): void
    {
        self::$services = [
            'router' => new \Kawnix\Routing\Route(),
            // Future core services can be added here
        ];
    }

    public static function getService(string $name)
    {
        return self::$services[$name] ?? null;
    }
}
