<?php

// Database connection settings
$databaseUrl = "mysql://bf1b99b2168a1d:3cc7e973@us-cluster-east-01.k8s.cleardb.net/heroku_8e2d5898e64e59e?reconnect=true";

// URL to extract connection information
$components = parse_url($databaseUrl);

// Extract connection details
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

// Collect POST data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ss", $name, $email);

    // Execute the statement
    if ($stmt->execute()) {
        echo "User added successfully";
    } else {
        die("Error executing statement: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>

<!-- HTML form -->
<form method="post" action="">
    Name: <input type="text" name="name" required>
    Email: <input type="email" name="email" required>
    <input type="submit" value="Add User">
</form>

