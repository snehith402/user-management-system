<?php
session_start();
include "includes/db.php";

if(isset($_POST['login'])){

$email=$_POST['email'];
$password=$_POST['password'];

$sql="SELECT * FROM users WHERE email='$email'";

$result=$conn->query($sql);

if($result->num_rows==1){

$user=$result->fetch_assoc();

if(password_verify($password,$user['password'])){

$_SESSION['user_id']=$user['id'];
$_SESSION['user_name']=$user['name'];

header("Location: dashboard.php");
exit();

}else{

echo "<script>alert('Incorrect Password');</script>";

}

}else{

echo "<script>alert('Email not found');</script>";

}

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Login</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="form-container">

<h2>User Login</h2>

<form method="POST">

<label>Email</label>

<input type="email" name="email" required>

<label>Password</label>

<input type="password" name="password" required>

<button type="submit" name="login">

Login

</button>

</form>

<br>

<a href="register.php">Create New Account</a>

</div>

</body>

</html>