<?php
// Debugging: Start of the script
echo "Debug: add_user.php script started.<br>";

// Include the database connection
include 'db_connection.php';

// Check if the database connection is successful
if ($conn === false) {
    echo "Debug: Database connection failed: " . pg_last_error() . "<br>";
    die("Database connection failed.");
} else {
    echo "Debug: Database connected successfully.<br>";
}

// Debug: Check if POST data is set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Debug: POST request detected.<br>";
    
    // Debug: Print all POST data
    echo "Debug: POST data: " . print_r($_POST, true) . "<br>";

    // Sanitize inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    // Debug: Print the sanitized inputs
    echo "Debug: Name=$name, Email=$email<br>";

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    if ($stmt === false) {
        echo "Debug: Error preparing statement: " . pg_last_error() . "<br>";
        die("Error preparing statement: " . pg_last_error());
    }

    $stmt->bind_param("ss", $name, $email);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Debug: User added successfully: Name=$name, Email=$email<br>";
        header("Location: view_users.php");
        exit();
    } else {
        echo "Debug: Error executing statement: " . pg_last_error() . "<br>";
    }

    $stmt->close();
} else {
    echo "Debug: No POST request detected.<br>";
}

// Close database connection
$conn->close();
?>

<!-- HTML form -->
<form method="post" action="">
    Name: <input type="text" name="name" required>
    Email: <input type="email" name="email" required>
    <input type="submit" value="Add User">
</form>
