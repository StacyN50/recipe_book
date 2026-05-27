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

$conn = mysqli_connect(
    $host,
    $username,
    $password,
    $database
);

/*
========================================
CHECK CONNECTION
========================================
*/

if(!$conn){

    die(
        "Database Connection Failed: "
        . mysqli_connect_error()
    );
}

?>
