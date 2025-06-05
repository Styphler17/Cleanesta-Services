<?php

// Autoloader
spl_autoload_register(function ($class) {
    // Convert namespace to a relative file path
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $baseDir   = __DIR__ . '/../';

    // Try path with original case
    $file = $baseDir . $classPath . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }

    // Fallback for case-insensitive file systems
    $file = $baseDir . strtolower($classPath) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

require_once __DIR__ . '/../app/config/params.php';
require_once __DIR__ . '/Database.php';
