<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "includes/db.php";

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Users</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="table-container">

<h2>Manage Users</h2>

<p style="text-align:center;">
    View, edit, and delete registered users.
</p>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo htmlspecialchars($row['name']); ?></td>

<td><?php echo htmlspecialchars($row['email']); ?></td>

<td>

<a href="edit_user.php?id=<?php echo $row['id']; ?>">
    ✏️ Edit
</a>

&nbsp;&nbsp;|&nbsp;&nbsp;

<a href="delete_user.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this user?');">
    🗑️ Delete
</a>

</td>

</tr>

<?php } ?>

</table>

<br>

<a href="dashboard.php">
    <button type="button">
        Back to Dashboard
    </button>
</a>

</div>

</body>
</html>