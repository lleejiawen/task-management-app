<?php
include '../includes/session.php';

header("Content-Type: application/json");
require_once '../includes/db.php';

//get search keywords
$type = isset($_GET['type']) ? $_GET['type'] : null;
$department = isset($_GET['department']) ? $_GET['department'] : null;

$query = "SELECT users.*, user_type.user_type as user_type_name, user_department.name as user_department_name
    FROM `users`
    LEFT JOIN `user_type` ON user_type.id = users.user_type
    LEFT JOIN `user_department` ON user_department.id = users.user_department
    WHERE 1";

if (!empty($type)) {
    $query .= " AND users.user_type = $type";
}

if (!empty($department)) {
    $query .= " AND users.user_department = $department";
}

$query .= " ORDER BY id DESC";

$result = mysqli_query($conn, $query);

if ($result) {
    $user = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $user[] = array(
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

    $json_response = json_encode($user);
    echo $json_response;
    mysqli_free_result($result);
    mysqli_close($conn);
} else {
    response(NULL, NULL, 200, "No Record Found");
}
?>
