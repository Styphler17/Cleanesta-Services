<?php

// Autoloader
spl_autoload_register(function ($class) {
    // Convert namespace to full file path
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = __DIR__ . '/../' . $class . '.php';
    
    // If the file exists, require it
    if (file_exists($file)) {
        require_once $file;
    }
});

require_once __DIR__ . '/../app/config/params.php';
require_once __DIR__ . '/../core/connexion.php';
