<?php
// loggly_config.php

require 'vendor/autoload.php'; // Make sure this path is correct

use Monolog\Logger;
use Monolog\Handler\SocketHandler;

// Replace with your actual Loggly token
$logglyToken = '9e1a9ba6-793d-4d1b-81d8-6cccf3511ba9';
$logglyUrl = "http://logs-01.loggly.com/inputs/{$logglyToken}/tag/http/";

// Create a new logger instance
$logger = new Logger('my_logger');

// Create a new handler for Loggly
$handler = new SocketHandler($logglyUrl, Logger::DEBUG);

// Push the handler to the logger
$logger->pushHandler($handler);

// Log an example message
$logger->info('This is a test log message');
