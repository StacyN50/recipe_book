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
