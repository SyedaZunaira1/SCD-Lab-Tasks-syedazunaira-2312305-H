<?php
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM students WHERE id='$id'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php?success=Student deleted successfully");
    } else {
        header("Location: dashboard.php?error=Error deleting student");
    }
} else {
    header("Location: dashboard.php");
}
exit();
?>