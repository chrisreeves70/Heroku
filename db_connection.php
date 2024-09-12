<?php

// Define the log file path (make sure this directory is writable by the web server)
$logFile = '/path/to/your/logs/db_connection.log';

// Function to log messages with timestamps
function logMessage($message) {
    global $logFile;
    $timestamp = date('Y-m-d H:i:s');
    $formattedMessage = "[$timestamp] $message" . PHP_EOL;
    error_log($formattedMessage, 3, $logFile);
}

// Connection URL provided by ClearDB for the Heroku MySQL database
$databaseUrl = "mysql://bf1b99b2168a1d:3cc7e973@us-cluster-east-01.k8s.cleardb.net/heroku_8e2d5898e64e59e?reconnect=true";

// Parse the database URL to extract connection details
$components = parse_url($databaseUrl);

// Extract the host name from the URL
$host = $components['host'];

// Extract the port number from the URL or use default MySQL port 3306 if not specified
$port = $components['port'] ?? 3306;

// Extract the database name from the URL, removing the leading '/'
$dbname = ltrim($components['path'], '/');

// Extract the user name from the URL
$user = $components['user'];

// Extract the password from the URL
$password = $components['pass'];

// Log the connection attempt
logMessage("Attempting to connect to MySQL database '$dbname' at host '$host' on port '$port'.");

// Create a new MySQLi connection
$conn = new mysqli($host, $user, $password, $dbname, $port);

// Check if the connection was successful
if ($conn->connect_error) {
    // Log the error and stop execution
    logMessage("Connection failed: " . $conn->connect_error);
    die("Error connecting to MySQL: " . $conn->connect_error);
}

// Log the success
logMessage("Connected successfully to MySQL database '$dbname'.");

// Output a success message if connection is established
echo "Connected successfully";

?>
