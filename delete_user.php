<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "includes/db.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {

        echo "<script>
                alert('User Deleted Successfully!');
                window.location='manage_users.php';
              </script>";

    } else {

        echo "<script>
                alert('Delete Failed!');
                window.location='manage_users.php';
              </script>";

    }

} else {

    header("Location: manage_users.php");
    exit();

}
?>