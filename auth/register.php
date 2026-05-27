<?php
session_start();
include("../config/db.php");

$message = "";

if (isset($_POST['register'])) {

    // CLEAN INPUTS
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // VALIDATION
    if (empty($name) || empty($email) || empty($password)) {

        $message = "<div class='error'>All fields are required.</div>";

    } else {

        try {

            /*
            ========================================
            CHECK IF EMAIL EXISTS (PDO VERSION)
            ========================================
            */

            $check = $conn->prepare("SELECT id FROM users WHERE email = :email");
            $check->execute([
                ":email" => $email
            ]);

            if ($check->fetch()) {

                $message = "<div class='error'>Email already exists.</div>";

            } else {

                /*
                ========================================
                HASH PASSWORD
                ========================================
                */

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                /*
                ========================================
                INSERT USER (PDO)
                ========================================
                */

                $stmt = $conn->prepare("
                    INSERT INTO users(name, email, password)
                    VALUES(:name, :email, :password)
                ");

                $result = $stmt->execute([
                    ":name" => $name,
                    ":email" => $email,
                    ":password" => $hashed_password
                ]);

                if ($result) {

                    $_SESSION['success'] = "Registration successful. Please login.";

                    header("Location: login.php");
                    exit();

                } else {

                    $message = "<div class='error'>Registration failed.</div>";
                }
            }

        } catch (PDOException $e) {

            $message = "<div class='error'>Database error: " . $e->getMessage() . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="auth-container">

    <form method="POST">

        <h2>Create Account</h2>

        <?php echo $message; ?>

        <input type="text" name="name" placeholder="Full Name" required>

        <input type="email" name="email" placeholder="Email Address" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="register">Register</button>

        <p>
            Already have an account?
            <a href="login.php">Login</a>
        </p>

    </form>

</div>

</body>
</html>
