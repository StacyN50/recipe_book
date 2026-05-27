<?php

/*
========================================
DATABASE CONFIGURATION
========================================
*/

$host = get_env("dpg-d8bc526gvqtc73afk7fg-a");
$username = get_env("recipe_book_91m6_user");
$password = get_env("iE06NhBmqIcVIbAZBgrJvLWmT34UhCb3");
$database = get_env("recipe_book_91m6");

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
