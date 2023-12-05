<?php
include '../includes/session.php';
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    
    $result = mysqli_query($conn, "UPDATE users
        SET username = '$username'
        WHERE id = $user_id;");

    if ($result) {
        $_SESSION['success_message'] = "Profile updated successfully.";
        header("Location: ../pages/profile.php");
    } else {
        $_SESSION['error_message'] = "Failed to edit profile.";
        header("Location: ../pages/profile.php");
    }

    
    mysqli_close($conn);
} else {
   $_SESSION['error_message'] = "Failed to edit profile.";
   header("Location: ../pages/profile.php");
}
?>