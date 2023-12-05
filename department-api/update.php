<?php
include '../includes/session.php';
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $remarks = $_POST['remarks'];
   
    $department_id = $_POST['department_id'];

    $result = mysqli_query($conn, "UPDATE user_department
        SET name = '$name', remarks = '$remarks'
        WHERE id = $department_id;");

    if ($result) {
        $_SESSION['success_message'] = "Department edit successfully.";
        header("Location: ../pages/department.php");
    } else {
        $_SESSION['error_message'] = "Failed to edit department.";
        header("Location: ../pages/department.php");
    }

    
    mysqli_close($conn);
} else {
   $_SESSION['error_message'] = "Failed to edit department.";
   header("Location: ../pages/department.php");
}
?>