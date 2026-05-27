$config = require __DIR__ . "/env.php";

$conn = new mysqli(
    $config["host"],
    $config["user"],
    $config["pass"],
    $config["name"],
    $config["port"]
);
