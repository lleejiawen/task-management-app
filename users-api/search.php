<?php
include '../includes/session.php';

header("Content-Type: application/json");
require_once '../includes/db.php';

//get search keywords
$keywords = isset($_GET['search']) ? $_GET['search'] : null;

$result = mysqli_query($conn, 
   "SELECT users.*
    FROM `users`
    WHERE username LIKE '%$keywords%' OR full_name LIKE '%$keywords%'
    ORDER BY id DESC
	");

if ($result) {
    $user = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $user[] = array(
            'id' => $row['id'],
            'username' => $row['username'],
            'full_name' => $row['full_name'],
            'email' => $row['email'],
            'user_type' => $row['user_type'],
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
