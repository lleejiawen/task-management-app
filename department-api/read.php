<?php
include '../includes/session.php';

header("Content-Type: application/json");
require_once '../includes/db.php';

$result = mysqli_query($conn, 
   "SELECT *
    FROM `user_department`
    ORDER BY id DESC
	");

if ($result) {
    $departments = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $departments[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'remarks' => $row['remarks']
        );
    }

    $json_response = json_encode($departments);
    echo $json_response;
    mysqli_free_result($result);
    mysqli_close($conn);

} else {
    response(NULL, NULL, 200, "No Record Found");
}
?>