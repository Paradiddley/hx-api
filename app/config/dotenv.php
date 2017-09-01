<?php

// Instantiate dotenv
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->overload();
$dotenv->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);
