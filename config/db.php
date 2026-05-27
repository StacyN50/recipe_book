<?php

// Database configuration
$dbhost = "dpg-d8bc526gvqtc73afk7fg-a.oregon-postgres.render.com";
$dbname = "recipe_book_91m6";
$dbuser = "recipe_book_91m6_user";
$dbpass = "iE06NhBmqIcVIbAZBgrJvLWmT34UhCb3";
$dbport = "5432";

try {

    // PostgreSQL PDO connection
    $conn = new PDO(
        "pgsql:host=$dbhost;port=$dbport;dbname=$dbname",
        $dbuser,
        $dbpass
    );

    // Enable error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Database connected successfully";

} catch (PDOException $e) {

    die("Connection failed: " . $e->getMessage());

}

?>
