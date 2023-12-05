<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        //successful login
        // if ($user && $user['password'] === $_POST['password']) {
        if ($user && password_verify($password, $user['password'])) {
            session_start();

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_type'] = $user['user_type'];

            header('location:../pages/dashboard.php');
            exit;
        } else {
            // login failed
            session_start();

            $_SESSION['error_message'] = "Login Failed: username or password is incorrect.";
            header('location:../index.php');
        }

        $stmt->close();
    } else {
        session_start();

        $_SESSION['error_message'] = "Login Failed: username or password is incorrect.";
        header('location:../index.php');
    }
} else {
    session_start();
        
    $_SESSION['error_message'] = "Login Failed: username or password is incorrect.";
    header('location:../index.php');
}
?>
