<?php
// Include database connection file
include 'db_connection.php';

// Check if the connection is established
if ($conn === false) {
    die("Connection failed: " . print_r(sqlsrv_errors(), true));
}

// Handle deletion
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare the SQL statement with a parameter
    $sql = "DELETE FROM Users WHERE id = ?";
    
    // Execute the query
    $stmt = sqlsrv_query($conn, $sql, array($id));
    
    if ($stmt === false) {
        die("Error deleting record: " . print_r(sqlsrv_errors(), true));
    } else {
        echo "<p>User deleted successfully.</p>";
    }
} else {
    echo "<p>No user ID provided for deletion.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Delete User</h1>
        <p>User has been deleted successfully.</p>
        <a href="view_users.php" class="btn btn-secondary mt-3">Back to User List</a>
    </div>
</body>
</html>

<?php
// Close the connection
sqlsrv_close($conn);
?>
