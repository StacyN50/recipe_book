<?php

/*
========================================
DATABASE CONFIGURATION
========================================
*/

$host = get_env("localhost");
$username = get_env("root");
$password = get_env("");
$database = get_env("recipe_book");

/*
========================================
CREATE CONNECTION
========================================
*/

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("DB Connection failed");
}
