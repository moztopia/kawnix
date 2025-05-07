<?php

namespace Kawnix\Core;

class Helper
{
    protected array $systemHelpers = [];
    protected array $userHelpers = [];

    public function loadHelpers()
    {
        // Load system-defined helpers
        $this->systemHelpers = $this->loadFromDirectory(__DIR__ . '/Helpers');

        // Load user-defined helpers only if the folder exists
        $userHelperDir = __DIR__ . '/../../app/Helpers';
        if (is_dir($userHelperDir)) {
            $this->userHelpers = $this->loadFromDirectory($userHelperDir);
        }
    }

    private function loadFromDirectory(string $directory): array
    {
        $loadedHelpers = [];

        foreach (glob($directory . '/*.php') as $helperFile) {
            require_once $helperFile;
            $loadedHelpers[] = basename($helperFile, '.php');
        }

        return $loadedHelpers;
    }

    public function getSystemHelpers(): array
    {
        return $this->systemHelpers;
    }

    public function getUserHelpers(): array
    {
        return $this->userHelpers;
    }

    public function getAllHelpers(): array
    {
        return array_merge($this->systemHelpers, $this->userHelpers);
    }
}
