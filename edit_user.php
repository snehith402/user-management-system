<?php
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

$id = (int)$_GET['id'];

try {

    // Get user details
    $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        throw new Exception("User not found.");
    }

    $user = $result->fetch_assoc();

    // Update user
    if (isset($_POST['update'])) {

        $name = trim($_POST['name']);
        $email = trim($_POST['email']);

        // Server-side validation
        if (empty($name) || empty($email)) {
            throw new Exception("All fields are required.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        $stmt = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $email, $id);

        if ($stmt->execute()) {
            header("Location: manage_users.php");
            exit();
        } else {
            throw new Exception("Failed to update user.");
        }
    }

} catch (Exception $e) {
    echo "<script>alert('" . $e->getMessage() . "');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <link rel="stylesheet" href="css/style.css">
    <script src="js/validation.js"></script>
</head>

<body>

<div class="form-container">

    <h2>Edit User</h2>

    <form method="POST" onsubmit="return validateRegister();">

        <label>Full Name</label>
        <input
            type="text"
            id="name"
            name="name"
            value="<?php echo htmlspecialchars($user['name']); ?>"
            required>

        <label>Email</label>
        <input
            type="email"
            id="email"
            name="email"
            value="<?php echo htmlspecialchars($user['email']); ?>"
            required>

        <!-- Hidden password field so validateRegister() doesn't fail -->
        <input type="hidden" id="password" value="123456">

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