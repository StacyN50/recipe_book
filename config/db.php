<?php

/*
========================================
DATABASE CONFIGURATION
========================================
*/

$host = "dpg-d8bc526gvqtc73afk7fg-a";
$username = "recipe_book_91m6_user";
$password = "iE06NhBmqIcVIbAZBgrJvLWmT34UhCb3";
$database = "recipe_book_91m6";

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
