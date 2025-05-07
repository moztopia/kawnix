<?php

namespace Kawnix;

use App\Services\Service;

class Kernel
{
    protected static array $services = [];

    public static function boot(): void
    {
        self::loadEnvironment();
        self::registerServices();
    }

    protected static function loadEnvironment(): void
    {
        if (file_exists(__DIR__ . '/../config/env.php')) {
            require_once __DIR__ . '/../config/env.php';
        }
    }

    protected static function registerServices(): void
    {
        // Default core services
        self::$services = [
            'router' => new \Kawnix\Core\Route(),
            'config' => new \Kawnix\Core\Config(),
            'helper' => new \Kawnix\Core\Helper(),
        ];

        // Auto-load user services
        $serviceDir = __DIR__ . '/../app/Services/';
        if (is_dir($serviceDir)) {
            foreach (glob($serviceDir . '*.php') as $serviceFile) {
                require_once $serviceFile;
                $className = 'App\\Services\\' . basename($serviceFile, '.php');

                if (class_exists($className) && is_subclass_of($className, Service::class)) {
                    self::$services[strtolower(basename($serviceFile, '.php'))] = new $className();
                }
            }
        }
    }

    public static function addService(string $name, object $service): void
    {
        self::$services[$name] = $service;
    }

    public static function getService(string $name)
    {
        return self::$services[$name] ?? null;
    }
}
