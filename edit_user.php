<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "includes/db.php";

if (!isset($_GET['id'])) {
    header("Location: manage_users.php");
    exit();
}

$id = (int) $_GET['id'];

// Get user details
$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) == 0) {
    die("User not found.");
}

$user = mysqli_fetch_assoc($result);

// Update user
if (isset($_POST['update'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $update = "UPDATE users
               SET name='$name',
                   email='$email'
               WHERE id=$id";

    if (mysqli_query($conn, $update)) {

        header("Location: manage_users.php");
        exit();

    } else {

        die("Update Failed: " . mysqli_error($conn));

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="form-container">

    <h2>Edit User</h2>

    <form method="POST">

        <label>Full Name</label>
        <input
            type="text"
            name="name"
            value="<?php echo htmlspecialchars($user['name']); ?>"
            required>

        <label>Email</label>
        <input
            type="email"
            name="email"
            value="<?php echo htmlspecialchars($user['email']); ?>"
            required>

        <button type="submit" name="update">
            Update User
        </button>

    </form>

    <br>

    <a href="manage_users.php">
        <button type="button">
            Back to Manage Users
        </button>
    </a>

</div>

</body>
</html>