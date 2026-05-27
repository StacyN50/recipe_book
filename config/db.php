<?php

/*
========================================
DATABASE CONFIGURATION
========================================
*/

$host = get_env("DB_HOST") ?: "localhost";
$username = get_env("DB_USER") ?: "root";
$password = get_env("DB_PASS") ?: "";
$database = get_env("DB_NAME") ?: "recipe_db";
$port = getenv("DB_PORT") ?: 3306;
/*
========================================
CREATE CONNECTION
========================================
*/

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("DB Connection failed");
}
