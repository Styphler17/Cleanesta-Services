<?php

// Initialisation des zones dynamiques
$content = "";

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'scrubhub');
define('DB_USER', 'root');
define('DB_PASS', '');

// Application configuration
define('SITE_NAME', 'ScrubHub');

// Dynamically determine the base URL from the current script location
$detectedBase = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
if ($detectedBase === '/' || $detectedBase === '\\') {
    $detectedBase = '';
}
define('BASE_URL', $detectedBase);
define('SITE_URL', 'http://localhost' . BASE_URL);

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure database connection is available for legacy includes
require_once __DIR__ . '/../../core/Database.php';

