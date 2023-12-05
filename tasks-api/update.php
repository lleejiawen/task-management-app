<?php
include '../includes/session.php';
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];
    $assigned_to = $_POST['assigned_to'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];
    $comments = $_POST['comments'];
    $customer_info = $_POST['customer_info'];

    $task_id = $_POST['task_id'];

    if (!empty($_POST['completion_date'])) {
        if ($status == 3) {
           $completion_date = strtotime($_POST['completion_date']);
        }else{
            $completion_date = null;
        }
    }else{
        //if status is completed and completion date not set --- will auto set current date
        if ($status == 3){
            $completion_date = time();
        }else{
            $completion_date = null;
        }
    }

    $result = mysqli_query($conn, "UPDATE tasks
        SET task_name = '$task_name', task_description = '$task_description', assigned_to = '$assigned_to', task_priority = '$priority', task_status = '$status', completion_date = '$completion_date', remarks = '$comments', customer_info = '$customer_info'
        WHERE id = $task_id;");

    if ($result) {
        $_SESSION['success_message'] = "Task edit successfully.";
        header("Location: ../pages/task.php?task_id={$task_id}");
    } else {
        $_SESSION['error_message'] = "Failed to edit task.";
        header("Location: ../pages/task.php?task_id={$task_id}");
    }

    
    mysqli_close($conn);
} else {
   $_SESSION['error_message'] = "Failed to edit task.";
   header("Location: ../pages/task.php?task_id={$task_id}");
}
?>