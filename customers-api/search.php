<?php
include '../includes/session.php';

header("Content-Type: application/json");
require_once '../includes/db.php';

//get search keywords
$keywords = isset($_GET['search']) ? $_GET['search'] : null;

$result = mysqli_query($conn, 
   "SELECT *, COALESCE(NULLIF(remarks, ''), '-') as remarks
    FROM `customer`
    WHERE name LIKE '%$keywords%' OR phone LIKE '%$keywords%' OR email LIKE '%$keywords%' OR remarks LIKE '%$keywords%'
    ORDER BY id DESC
	");

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
