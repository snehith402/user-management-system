<?php
include "includes/db.php";

if (isset($_POST['register'])) {

    try {

        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Server-side Validation
        if (empty($name) || empty($email) || empty($password)) {
            throw new Exception("All fields are required.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        if (strlen($password) < 6) {
            throw new Exception("Password must be at least 6 characters.");
        }

        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            throw new Exception("Email already exists!");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user
        $stmt = $conn->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "<script>alert('Registration Successful!'); window.location='login.php';</script>";
        } else {
            throw new Exception("Registration failed.");
        }

    } catch (Exception $e) {
        echo "<script>alert('" . $e->getMessage() . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

    <link rel="stylesheet" href="css/style.css">
    <script src="js/validation.js"></script>

</head>
<body>

<div class="form-container">

    <h2>User Registration</h2>

    <form method="POST" onsubmit="return validateRegister();">

        <label>Full Name</label>
        <input type="text" id="name" name="name" required>

        <label>Email</label>
        <input type="email" id="email" name="email" required>

        <label>Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="register">
            Register
        </button>

    </form>

    <br>

    <a href="login.php">Already have an account? Login</a>

</div>

</body>
</html>