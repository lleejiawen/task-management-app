<?php
include '../includes/session.php';
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $remarks = $_POST['remarks'];
    $created_at = time();
   
    $result = mysqli_query($conn, "INSERT INTO user_department (name, remarks, created_at) VALUES ('$name', '$remarks', '$created_at')");


    if ($result) {
        $_SESSION['success_message'] = "Department added successfully.";
        header('Location: ../pages/department.php');
    } else {
        $_SESSION['error_message'] = "Failed to add department.";
        header('Location: ../pages/department.php');
    }

    
    mysqli_close($conn);
} else {
    $_SESSION['error_message'] = "Failed to add department.";
    header('Location: ../pages/department.php');
}
?>