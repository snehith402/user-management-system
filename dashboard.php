<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="dashboard-container">

    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?> 🎉</h2>

    <p style="text-align:center;">
        You have successfully logged in to the User Management System.
    </p>

    <br>

    <a href="manage_users.php">
        <button type="button">
            Manage Users
        </button>
    </a>

    <br><br>

    <a href="logout.php">
        <button type="button">
            Logout
        </button>
    </a>

</div>

</body>

</html>