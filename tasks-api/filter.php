<?php
include '../includes/session.php';

header("Content-Type: application/json");
require_once '../includes/db.php';

//get search keywords
$status = isset($_GET['status']) ? $_GET['status'] : null;
$priority = isset($_GET['priority']) ? $_GET['priority'] : null;
$assigned = isset($_GET['assigned']) ? $_GET['assigned'] : null;
$condition = '';

$query = "SELECT tasks.*, tasks_priority.priority as priority, tasks_status.status as status, COALESCE(NULLIF(tasks.completion_date, ''), '-') as completion_date, COALESCE(NULLIF(users.full_name, ''), '-') as assigned_to, COALESCE(NULLIF(tasks.remarks, ''), '-') as remarks, COALESCE(NULLIF(customer.name, ''), '-') as customer_info
    FROM `tasks`
    LEFT JOIN `tasks_priority` ON tasks.task_priority = tasks_priority.id
    LEFT JOIN `tasks_status` ON tasks.task_status = tasks_status.id
    LEFT JOIN `users` ON tasks.assigned_to = users.id
    LEFT JOIN `customer` ON tasks.customer_info = customer.id
    WHERE 1"; 

if (!empty($priority)) {
    $query .= " AND tasks_priority.id = $priority";
}

if (!empty($status)) {
    $query .= " AND tasks_status.id = $status";
}

if (!empty($assigned)) {
    $query .= " AND tasks.assigned_to = $assigned";
}

$query .= " ORDER BY id DESC";
    
$result = mysqli_query($conn, $query);

if ($result) {
    $tasks = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $tasks[] = array(
            'id' => $row['id'],
            'task_name' => $row['task_name'],
            'task_description' => $row['task_description'],
            'assigned_to' => $row['assigned_to'],
            'task_priority' => $row['priority'],
            'task_status' => $row['status'],
            'completion_date' => $row['completion_date'],
            'remarks' => $row['remarks'],
            'customer_info' => $row['customer_info']
        );
    }

    $json_response = json_encode($tasks);
    echo $json_response;
    mysqli_free_result($result);
    mysqli_close($conn);
    exit();
}else {
    response(NULL, NULL, 200, "No Record Found");
}
?>
