<?php

// Include Composer's autoloader
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\LogglyHandler;

// Define Loggly token and endpoint
$logglyToken = 'YOUR_LOGGLY_TOKEN'; // Replace with your Loggly token
$logglyEndpoint = "https://logs-01.loggly.com/inputs/$logglyToken/tag/http/";

// Create a Logger instance
$logger = new Logger('db_connection_logger');

// Add a Loggly handler
$logger->pushHandler(new LogglyHandler($logglyEndpoint, Logger::DEBUG));

// Define database URL
$databaseUrl = "mysql://bf1b99b2168a1d:3cc7e973@us-cluster-east-01.k8s.cleardb.net/heroku_8e2d5898e64e59e?reconnect=true";

// URL to extract connection information
$components = parse_url($databaseUrl);

// Extract connection details
$host = $components['host'];
$port = $components['port'] ?? 3306; // Default MySQL port is 3306
$dbname = ltrim($components['path'], '/');
$user = $components['user'];
$password = $components['pass'];

// Log connection attempt
$logger->info("Attempting to connect to MySQL database '$dbname' at host '$host' on port '$port'.");

// Create MySQL connection
$conn = new mysqli($host, $user, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    $logger->error("Connection failed: " . $conn->connect_error);
    die("Error connecting to MySQL: " . $conn->connect_error);
}

// Log successful connection
$logger->info("Connected successfully to MySQL database '$dbname'.");

echo "Connected successfully";

?>
