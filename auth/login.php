<?php
session_start();
include("../config/db.php");

$message = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $message = "<div class='error'>All fields are required.</div>";
    } else {

        try {

            /*
            ========================================
            FETCH USER (PDO SAFE)
            ========================================
            */

            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([
                ":email" => $email
            ]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            /*
            ========================================
            VERIFY PASSWORD
            ========================================
            */

            if ($user && password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];

                header("Location: ../dashboard.php");
                exit();

            } else {
                $message = "<div class='error'>Invalid email or password.</div>";
            }

        } catch (PDOException $e) {
            $message = "<div class='error'>Database error: " . $e->getMessage() . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="auth-container">

    <form method="POST">

        <h2>Login</h2>

        <?php echo $message; ?>

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>

        <p>No account?
            <a href="register.php">Register</a>
        </p>

    </form>

</div>

</body>
</html>
