<?php
use Monolog\Logger;
use Monolog\Handler\LogglyHandler;

// Initialize logger
$log = new Logger('loggly');

// Use your API Token and set the log level (e.g., INFO)
$log->pushHandler(new LogglyHandler('2c8f1f6e-b7d3-4682-9b36-8b90ab233298', Logger::INFO));

// Example of logging a message
$log->info('Log message to Loggly');

