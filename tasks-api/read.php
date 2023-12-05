<?php
include '../includes/session.php';

header("Content-Type: application/json");
require_once '../includes/db.php';

$result = mysqli_query($conn, 
   "SELECT tasks.*, tasks_priority.priority as priority, tasks_status.status as status, COALESCE(NULLIF(tasks.completion_date, ''), '-') as completion_date, COALESCE(NULLIF(users.full_name, ''), '-') as assigned_to, COALESCE(NULLIF(tasks.remarks, ''), '-') as remarks, COALESCE(NULLIF(customer.name, ''), '-') as customer_info
    FROM `tasks`
	LEFT JOIN `tasks_priority` ON tasks.task_priority = tasks_priority.id
	LEFT JOIN `tasks_status` ON tasks.task_status = tasks_status.id
    LEFT JOIN `users` ON tasks.assigned_to = users.id
    LEFT JOIN `customer` ON tasks.customer_info = customer.id
    ORDER BY id DESC
	");

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

} else {
    response(NULL, NULL, 200, "No Record Found");
}

// function response($id, $task_name, $task_description, $assigned_to, $task_priority, $task_status, $completion_date, $remarks, $customer_info)
// {	
//     $response['id'] = $id;
//     $response['task_name'] = $task_name;
//     $response['task_description'] = $task_description;
//     $response['assigned_to'] = ($assigned_to !== null && $assigned_to !== '') ? $assigned_to : '-';
//     $response['task_priority']  = ($task_priority !== null && $task_priority !== '') ? $task_priority : '-';
//     $response['task_status']  = ($task_status !== null && $task_status !== '') ? $task_status : '-';
//     $response['completion_date'] = ($completion_date !== null && $completion_date !== '') ? $completion_date : '-';
//     $response['remarks'] = ($remarks !== null && $remarks !== '') ? $remarks : '-';
//     $response['customer_info'] = ($customer_info !== null && $customer_info !== '') ? $customer_info : '-';

//     $json_response = json_encode($response);
//     echo $json_response;
// }

?>
