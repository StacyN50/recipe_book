<?php

$config = require __DIR__ . "/env.php";

// Validate env variables first
foreach ($config as $key => $value) {
    if ($value === null || $value === "") {
        die("Missing environment variable for: $key");
    }
}

$conn = new mysqli(
    $config["host"],
    $config["user"],
    $config["pass"],
    $config["name"],
    $config["port"]
);

if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
