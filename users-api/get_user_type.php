<?php
include '../includes/session.php';

header("Content-Type: application/json");
require_once '../includes/db.php';

$query = "SELECT id, user_type FROM user_type";
$result = $conn->query($query);

$options = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options[] = $row;
    }
}

echo json_encode($options);

$conn->close();


