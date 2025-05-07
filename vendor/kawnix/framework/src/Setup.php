<?php

namespace Kawnix;

class Setup
{
    public static function install()
    {
        $directories = [
            "app/Controllers",
            "app/Models",
            "app/Services",
            "config",
            "routes",
            "storage/logs",
            "public/assets",
        ];

        foreach ($directories as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
                echo "✅ Created directory: $dir\n";
            }
        }

        // Copy index.php to the user's project
        $source = __DIR__ . '/../public/index.php';
        $destination = getcwd() . '/public/index.php';

        if (!file_exists($destination)) {
            copy($source, $destination);
            echo "✅ Installed core index.php\n";
        }
    }
}
