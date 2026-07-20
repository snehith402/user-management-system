<?php
session_start();
include "includes/db.php";

if (isset($_POST['login'])) {

    try {

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Server-side Validation
        if (empty($email) || empty($password)) {
            throw new Exception("All fields are required.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        // Prepared Statement
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 1) {

            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];

                header("Location: dashboard.php");
                exit();

            } else {
                throw new Exception("Incorrect Password");
            }

        } else {
            throw new Exception("Email not found");
        }

    } catch (Exception $e) {
        echo "<script>alert('" . $e->getMessage() . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

    <link rel="stylesheet" href="css/style.css">
    <script src="js/validation.js"></script>

</head>

<body>

<div class="form-container">

    <h2>User Login</h2>

    <form method="POST" onsubmit="return validateLogin();">

        <label>Email</label>

        <input type="email" id="email" name="email" required>

        <label>Password</label>

        <input type="password" id="password" name="password" required>

        <button type="submit" name="login">
            Login
        </button>

    </form>

    <br>

    <a href="register.php">Create New Account</a>

</div>

</body>
</html>