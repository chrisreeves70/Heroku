<?php
// Include Composer's autoload file
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\LogglyHandler;

// Create a log channel
$log = new Logger('my_app');
$log->pushHandler(new LogglyHandler('2c8f1f6e-b7d3-4682-9b36-8b90ab233298', Logger::DEBUG));

// Add a log entry
$log->info('Index page accessed');

// HTML content starts here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Welcome to the Activity 6 DevOps</h1>
        <a href="add_user.php" class="btn btn-primary mt-3">Add User</a>
        <a href="view_users.php" class="btn btn-secondary mt-3">View Users</a>
    </div>
</body>
</html>
