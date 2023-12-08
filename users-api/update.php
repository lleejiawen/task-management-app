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

    $login_user = $_SESSION['user_id'];

    //check if username or email exists
    $check_exists = mysqli_query($conn, "SELECT username FROM `users` WHERE (username = '$username' OR email = '$email') AND id != $user_id");
    $check = mysqli_fetch_assoc($check_exists);

    if ($check) {
        $_SESSION['error_message'] = "Failed to edit profile. Username or email already exists.";
        //if edit self profile
        if ($login_user == $user_id) {
            header("Location: ../pages/profile.php");
        } else {
            header("Location: ../pages/user.php?user_id={$user_id}");
        }
    } else {
        $result = mysqli_query($conn, "UPDATE users
        SET username = '$username', full_name = '$full_name', email = '$email', user_type = '$user_type', user_department = '$user_department'
        WHERE id = $user_id;");

        if ($result) {
             $_SESSION['success_message'] = "User profit edit successfully.";

             //update user type session
             $_SESSION['user_type'] = $user_type;

            //if edit self profile
            if ($login_user == $user_id) {
                header("Location: ../pages/profile.php");
            } else {
                header("Location: ../pages/user.php?user_id={$user_id}");
            }
        } else {
            $_SESSION['error_message'] = "Failed to edit user profile.";

            //if edit self profile
            if ($login_user == $user_id) {
                header("Location: ../pages/profile.php");
            } else {
                header("Location: ../pages/user.php?user_id={$user_id}");
            }
        }
    }
    
    mysqli_close($conn);
} else {
   $_SESSION['error_message'] = "Failed to edit user profile.";
   header("Location: ../pages/user.php?user_id={$user_id}");
}
?>