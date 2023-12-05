<?php
include '../includes/session.php';

header("Content-Type: application/json");
require_once '../includes/db.php';

$result = mysqli_query($conn, 
   "SELECT users.*, user_type.user_type as user_type_name, user_department.name as user_department_name
    FROM `users`
    LEFT JOIN `user_type` ON user_type.id = users.user_type
    LEFT JOIN `user_department` ON user_department.id = users.user_department
    ORDER BY id DESC
	");

if ($result) {
    $users = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = array(
            'id' => $row['id'],
            'username' => $row['username'],
            'full_name' => $row['full_name'],
            'email' => $row['email'],
            'user_type' => $row['user_type'],
            'user_department' => $row['user_department'],
            'user_type_name' => $row['user_type_name'],
            'user_department_name' => $row['user_department_name'],
        );
    }

    $json_response = json_encode($users);
    echo $json_response;
    mysqli_free_result($result);
    mysqli_close($conn);

} else {
    response(NULL, NULL, 200, "No Record Found");
}
?>