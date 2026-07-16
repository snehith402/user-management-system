<?php
include "includes/db.php";

if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $check = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists!');</script>";
    } else {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users(name,email,password)
                VALUES('$name','$email','$hashedPassword')";

        if ($conn->query($sql)) {
            echo "<script>alert('Registration Successful!');</script>";
        } else {
            echo "<script>alert('".$conn->error."');</script>";
        }
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

</head>
<body>

<div class="form-container">

    <h2>User Registration</h2>

    <form method="POST">

        <label>Full Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="register">
            Register
        </button>

    </form>

    <br>

    <a href="login.php">Already have an account? Login</a>

</div>

</body>
</html>