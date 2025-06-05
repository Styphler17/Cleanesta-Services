<?php
if (session_status() === PHP_SESSION_NONE) session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set the base path
define('BASE_PATH', dirname(__DIR__));

// Include the initialization file
require_once __DIR__ . '/core/init.php';

// If accessing the root directory, set the page to home
if ($_SERVER['REQUEST_URI'] === '/scrub/' || $_SERVER['REQUEST_URI'] === '/scrub/') {
    $_GET['page'] = 'home';
}

// Include the router
require_once __DIR__ . '/app/routers/index.php';

// Do NOT include the main template here unconditionally!

global $pdo;
