<?php
session_start();
include("../config/db.php");

/*
========================================
REGISTER USER
========================================
*/

$message = "";

if(isset($_POST['register'])){

    // CLEAN INPUTS
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    /*
    ========================================
    VALIDATION
    ========================================
    */

    if(empty($name) || empty($email) || empty($password)){

        $message = "<div class='error'>All fields are required.</div>";

    }else{

        /*
        ========================================
        CHECK IF EMAIL EXISTS
        ========================================
        */

        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if($check->num_rows > 0){

            $message = "<div class='error'>Email already exists.</div>";

        }else{

            /*
            ========================================
            HASH PASSWORD
            ========================================
            */

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            /*
            ========================================
            INSERT USER
            ========================================
            */

            $stmt = $conn->prepare("
                INSERT INTO users(name, email, password)
                VALUES(?, ?, ?)
            ");

            if($stmt){

                $stmt->bind_param(
                    "sss",
                    $name,
                    $email,
                    $hashed_password
                );

                if($stmt->execute()){

                    $_SESSION['success'] =
                    "Registration successful. Please login.";

                    header("Location: login.php");
                    exit();

                }else{

                    $message =
                    "<div class='error'>
                        Registration failed.
                    </div>";
                }

                $stmt->close();

            }else{

                $message =
                "<div class='error'>
                    Database error: ".$conn->error."
                </div>";
            }
        }

        $check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <link rel="stylesheet"
          href="../assets/css/style.css">

</head>

<body>

<div class="auth-container">

    <form method="POST">

        <h2>Create Account</h2>

        <!-- DISPLAY MESSAGE -->
        <?php echo $message; ?>

        <input
            type="text"
            name="name"
            placeholder="Full Name"
            required
        >

        <input
            type="email"
            name="email"
            placeholder="Email Address"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Password"
            required
        >

        <button
            type="submit"
            name="register"
        >
            Register
        </button>

        <p>
            Already have an account?
            <a href="login.php">Login</a>
        </p>

    </form>

</div>

</body>
</html>