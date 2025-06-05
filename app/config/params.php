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
define('SITE_URL', 'http://localhost/scrub');

define('BASE_URL', '/scrub');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

global $connexion;
try {
    $connexion = new PDO(
        "mysql:host=" . 'localhost' . ";dbname=" . 'scrubhub',
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
        ]
    );
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}