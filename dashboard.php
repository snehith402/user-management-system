<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}
?>

<!DOCTYPE html>

<html>

<head>

<title>Dashboard</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="dashboard-container">

<h2>Welcome, <?php echo $_SESSION['user_name']; ?> 🎉</h2>

<p>You have successfully logged in.</p>

<a href="manage_users.php">

<button>

Manage Users

</button>

</a>

<br><br>

<a href="logout.php">

<button>

Logout

</button>

</a>

</div>

</body>

</html>