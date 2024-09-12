<?php
// Debugging: Start of the script
echo "Debug: add_user.php script started.<br>";

// Include the database connection
include 'db_connection.php';

// Check if the database connection is successful
if ($conn->connect_error) {
    echo "Debug: Database connection failed: " . $conn->connect_error . "<br>";
    die("Database connection failed.");
} else {
    echo "Debug: Database connected successfully.<br>";
}

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Debug: POST request detected.<br>";

    // Sanitize inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    // Debug: Print the sanitized inputs
    echo "Debug: Name=$name, Email=$email<br>";

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    if ($stmt === false) {
        echo "Debug: Error preparing statement: " . $conn->error . "<br>";
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ss", $name, $email);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Debug: User added successfully: Name=$name, Email=$email<br>";
        header("Location: view_users.php");
        exit();
    } else {
        echo "Debug: Error executing statement: " . $stmt->error . "<br>";
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
