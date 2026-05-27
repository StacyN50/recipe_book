<?php

/*
========================================
DATABASE CONFIGURATION
========================================
*/

$host = "localhost";
$username = "root";
$password = "";
$database = "recipe_book";

/*
========================================
CREATE CONNECTION
========================================
*/

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("DB Connection failed");
}
