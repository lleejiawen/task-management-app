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
   
    $result = mysqli_query($conn, "INSERT INTO users (username, full_name, email, password, user_type, user_department, created_at) VALUES ('$username', '$full_name', '$email', '$hash', '$user_type', '$user_department', '$created_at')");


    if ($result) {
        $_SESSION['success_message'] = "User added successfully.";
        header('Location: ../pages/users.php');
    } else {
        $_SESSION['error_message'] = "Failed to add user.";
        header('Location: ../pages/users.php');
    }

    
    mysqli_close($conn);
} else {
    $_SESSION['error_message'] = "Failed to add user.";
    header('Location: ../pages/users.php');
}
?>