<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Getting the environment
$dotenv = new Dotenv\Dotenv(__DIR__ . '/../config');
$dotenv->load();

// Load the proper configuration file based on the environment
$parameters = require __DIR__ . '/../config/' . getenv('ENV') . '.php';

// Build a Disco container using the Factory class
$container = Framework\Factory::buildContainer($parameters);

// Including the routes
require __DIR__ . '/../src/routes.php';

// Running the application to handle the response
$container->get('application')
          ->run();
