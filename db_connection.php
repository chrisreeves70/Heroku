<?php

$databaseUrl = "mysql://bf1b99b2168a1d:3cc7e973@us-cluster-east-01.k8s.cleardb.net/heroku_8e2d5898e64e59e?reconnect=true";

// URL to extract connection information
$components = parse_url($databaseUrl);

// Extract the connection details
$host = $components['host'];
$port = $components['port'] ?? 5432;
$dbname = ltrim($components['path'], '/');
$user = $components['user'];
$password = $components['pass'];

// Create the connection string
$connectionString = "host=$host port=$port dbname=$dbname user=$user password=$password";

// Create connection
$conn = pg_connect($connectionString);

// Check connection
if ($conn === false) {
    die("Error connecting to PostgreSQL: " . pg_last_error());
}
echo "Connected successfully";
?>
