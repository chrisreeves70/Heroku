<?php

$databaseUrl = "postgres://untvvdv7d0ff:pf596cd903192c82834e2091c82761d383a55731b171fb4a308aeb014330a585b@c5hilnj7pn10vb.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com:5432/d7fnbkag5p2q0g";

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
