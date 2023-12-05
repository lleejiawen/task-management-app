<?php
include '../includes/session.php';
include '../includes/db.php';

if (isset($_GET['department_id']) && !empty($_GET['department_id'])) {
    $department_id = $_GET['department_id'];

    $result = mysqli_query($conn, "DELETE FROM `user_department` WHERE id = $department_id");

    if ($result) {
        $_SESSION['success_message'] = "Department deleted successfully.";
        header("Location: ../pages/department.php");
    } else {
        $_SESSION['error_message'] = "Failed to delete department.";
        header("Location: ../pages/department.php");
    }

    mysqli_close($conn);
} else {
    $_SESSION['error_message'] = "Failed to delete department.";
    header("Location: ../pages/department.php");
}
?>
