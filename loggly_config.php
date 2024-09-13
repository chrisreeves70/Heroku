<?php
use Monolog\Logger;
use Monolog\Handler\SocketHandler;

require 'vendor/autoload.php';

// Create a new logger instance
$logger = new Logger('my_logger');

// Add a Loggly handler
$logger->pushHandler(new SocketHandler('http://logs-01.loggly.com/inputs/2c8f1f6e-b7d3-4682-9b36-8b90ab233298/tag/http/', Logger::DEBUG));

// Optionally, you can log a test message
$logger->info('Logger initialized.');
