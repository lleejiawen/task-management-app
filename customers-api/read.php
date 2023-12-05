<?php
include '../includes/session.php';

header("Content-Type: application/json");
require_once '../includes/db.php';

$result = mysqli_query($conn, 
   "SELECT * FROM `customer` ORDER BY id DESC");

if ($result) {
    $tasks = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $tasks[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'remarks' => $row['remarks'],
            'created_at' => $row['created_at']
        );
    }

    $json_response = json_encode($tasks);
    echo $json_response;
    mysqli_free_result($result);
    mysqli_close($conn);

} else {
    response(NULL, NULL, 200, "No Record Found");
}
?>