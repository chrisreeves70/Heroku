<?php
require 'vendor/autoload.php'; // Ensure you include Composer's autoload file

use Monolog\Logger;
use Monolog\Handler\LogglyHandler;

// Initialize logger
$log = new Logger('loggly');

// Use the HTTP/S Event Endpoint URL
$logglyUrl = 'http://logs-01.loggly.com/inputs/9e1a9ba6-793d-4d1b-81d8-6cccf3511ba9/tag/http/';

$log->pushHandler(new LogglyHandler($logglyUrl, Logger::INFO));

// Example of logging a message
$log->info('Log message to Loggly');
