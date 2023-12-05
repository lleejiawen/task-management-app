<?php
include '../includes/session.php';
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];
    $user_department = $_POST['user_department'];

    $user_id = $_POST['user_id'];

    $result = mysqli_query($conn, "UPDATE users
        SET username = '$username', full_name = '$full_name', email = '$email', user_type = '$user_type', user_department = '$user_department'
        WHERE id = $user_id;");

    if ($result) {
        $_SESSION['success_message'] = "User edit successfully.";
        header("Location: ../pages/user.php?user_id={$user_id}");
    } else {
        $_SESSION['error_message'] = "Failed to edit user.";
        header("Location: ../pages/user.php?user_id={$user_id}");
    }

    
    mysqli_close($conn);
} else {
   $_SESSION['error_message'] = "Failed to edit user.";
   header("Location: ../pages/user.php?user_id={$user_id}");
}
?>