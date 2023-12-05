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
    $created_at = time();

    if (!empty($_POST['completion_date'])) {
        $completion_date = strtotime($_POST['completion_date']);
    }else{
        //if status is completed and completion date not set --- will auto set current date
        if ($status == 3){
            $completion_date = time();
        }else{
            $completion_date = null;
        }
    }


    $result = mysqli_query($conn, "INSERT INTO tasks (task_name, task_description, assigned_to, task_priority, task_status, completion_date, remarks, customer_info, created_at ) VALUES ('$task_name', '$task_description', '$assigned_to', '$priority', '$status', '$completion_date', '$comments', '$customer_info', '$created_at')");


    if ($result) {
        $_SESSION['success_message'] = "Task added successfully.";
        header('Location: ../pages/tasks.php');
    } else {
        $_SESSION['error_message'] = "Failed to add task.";
        header('Location: ../pages/tasks.php');
    }

    
    mysqli_close($conn);
} else {
    //echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    $_SESSION['error_message'] = "Failed to add task.";
    header('Location: ../pages/tasks.php');
}
?>