<?php
require 'vendor/autoload.php'; // Include Composer's autoload file
require 'loggly_config.php'; // Include Loggly configuration

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
    $log->error("Error connecting to MySQL: " . $conn->connect_error);
    die("Error connecting to MySQL: " . $conn->connect_error);
}

// Collect POST data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    if ($stmt === false) {
        $log->error("Error preparing statement: " . $conn->error);
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ss", $name, $email);

    // Execute the statement
    if ($stmt->execute()) {
        $log->info("User added successfully: $name, $email");
        echo "User added successfully";
    } else {
        $log->error("Error executing statement: " . $stmt->error);
        die("Error executing statement: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>

<!-- HTML form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Add User</h1>
        <form method="post" action="">
            Name: <input type="text" name="name" required>
            Email: <input type="email" name="email" required>
            <input type="submit" value="Add User">
        </form>
        <a href="index.php" class="btn btn-secondary mt-3">Back to Home</a>
    </div>
</body>
</html>

