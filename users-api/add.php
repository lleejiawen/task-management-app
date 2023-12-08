<?php
include '../includes/session.php';
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_BCRYPT);

    $user_type = $_POST['user_type'];
    $user_department = $_POST['user_department'];
    $created_at = time();

    //check if username or email exists
    $check_exists = mysqli_query($conn, "SELECT username FROM `users` WHERE username = '$username' OR email = '$email'");
    $check = mysqli_fetch_assoc($check_exists);

    if ($check) {
        $_SESSION['error_message'] = "Failed to add user. Username or email already exists.";
        header('Location: ../pages/users.php');
    } else {
        $result = mysqli_query($conn, "INSERT INTO users (username, full_name, email, password, user_type, user_department, created_at) VALUES ('$username', '$full_name', '$email', '$hash', '$user_type', '$user_department', '$created_at')");

        if ($result) {
            $_SESSION['success_message'] = "User added successfully.";
            header('Location: ../pages/users.php');
        } else {
            $_SESSION['error_message'] = "Failed to add user.";
            header('Location: ../pages/users.php');
        }
    }
    
    mysqli_close($conn);
} else {
    $_SESSION['error_message'] = "Failed to add user.";
    header('Location: ../pages/users.php');
}
?>