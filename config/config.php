<?php

// Show errors (development mode)
ini_set("display_errors", true);
error_reporting(E_ALL);

// Set default timezone
date_default_timezone_set('Asia/Kolkata');


// Database settings
define("DB_HOST", "localhost");
define("DB_NAME", "property_system");
define("DB_USER", "root");
define("DB_PASS", "admin123");

// DSN for PDO (optional, for convenience)
define("DB_DSN", "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME);


// Project paths

define("BASE_URL", "http://localhost/Property_Amenity_Marketing_System");
define("UPLOAD_PATH", dirname(__DIR__) . "/public/uploads/media");


// Admin default credentials (optional, temporary)
// For production: use DB-stored users instead

define("ADMIN_USERNAME", "admin");
define("ADMIN_PASSWORD", "root");


// Global Exception Handler

function handleException($exception) {
    echo "<pre><strong>ERROR:</strong> " . $exception->getMessage() . "</pre>";
    error_log($exception->getMessage());
}
set_exception_handler('handleException');
?>
