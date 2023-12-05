<?php
include '../includes/session.php';
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $currentPassword = $_POST['current'];
    $newPassword = $_POST['new'];

    $getCurrent = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id;");

    //get existing password
    if ($getCurrent) {
        while ($row = mysqli_fetch_assoc($getCurrent)) {
            $existingHashedPassword = $row['password'];
        }
    }

    if ($existingHashedPassword) {
        if (password_verify($currentPassword, $existingHashedPassword)) {
            if (!empty($newPassword)) {
                $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                $result = mysqli_query($conn, "UPDATE users
                SET password = '$newHashedPassword'WHERE id = $user_id;");
            }
        } 
    }
    if ($result) {
        $_SESSION['success_message'] = "Password changed successfully.";
        // change self password
        if ($_SESSION['user_id'] == $user_id) {
            header("Location: ../pages/profile.php");
        } else{
            header("Location: ../pages/user.php?user_id={$user_id}");
        }
    } else {
        $_SESSION['error_message'] = "Password does not matched. Failed to change password.";
        if ($_SESSION['user_id'] == $user_id) {
            header("Location: ../pages/profile.php");
        } else{
            header("Location: ../pages/user.php?user_id={$user_id}");
        }
    }

    mysqli_close($conn);

} else {
   $_SESSION['error_message'] = "Password does not matched. Failed to change password.";
    if ($_SESSION['user_id'] == $user_id) {
            header("Location: ../pages/profile.php");
        } else{
            header("Location: ../pages/user.php?user_id={$user_id}");
        }
}
?>