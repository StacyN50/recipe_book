<?php

$config = require __DIR__ . "/env.php";

try {

    $conn = new PDO(
        "pgsql:host={$config['host']};port={$config['port']};dbname={$config['name']}",
        $config['user'],
        $config['pass']
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    die("DB CONNECTION FAILED: " . $e->getMessage());

}
