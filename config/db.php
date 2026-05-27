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

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("DB Connection failed");
}
