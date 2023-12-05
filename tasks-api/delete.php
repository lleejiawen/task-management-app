<?php
include '../includes/session.php';
include '../includes/db.php';

if (isset($_GET['task_id']) && !empty($_GET['task_id'])) {
    $task_id = $_GET['task_id'];

    $result = mysqli_query($conn, "DELETE FROM `tasks` WHERE id = $task_id");

    if ($result) {
        $_SESSION['success_message'] = "Task deleted successfully.";
        header("Location: ../pages/tasks.php");
    } else {
        $_SESSION['error_message'] = "Failed to delete task.";
        header("Location: ../pages/tasks.php");
    }

    mysqli_close($conn);
} else {
    $_SESSION['error_message'] = "Failed to delete task.";
    header("Location: ../pages/tasks.php");
}
?>
