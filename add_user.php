<?php

$databaseUrl = "mysql://bf1b99b2168a1d:3cc7e973@us-cluster-east-01.k8s.cleardb.net/heroku_8e2d5898e64e59e?reconnect=true";

// URL to extract connection information
$components = parse_url($databaseUrl);

// Extract the connection details
$host = $components['host'];
$port = $components['port'] ?? 3306; // Default MySQL port is 3306
$dbname = ltrim($components['path'], '/');
$user = $components['user'];
$password = $components['pass'];

// Create connection
$conn = new mysqli($host, $user, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Error connecting to MySQL: " . $conn->connect_error);
}
echo "Connected successfully";
?>

