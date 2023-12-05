<?php
include '../includes/session.php';
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $remarks = $_POST['remarks'];
    $created_at = time();
   
    $result = mysqli_query($conn, "INSERT INTO customer (name, email, phone, remarks, created_at) VALUES ('$name', '$email', '$phone', '$remarks', '$created_at')");


    if ($result) {
        $_SESSION['success_message'] = "Customer added successfully.";
        header('Location: ../pages/customers.php');
    } else {
        $_SESSION['error_message'] = "Failed to add customer.";
        header('Location: ../pages/customers.php');
    }

    
    mysqli_close($conn);
} else {
    //echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    $_SESSION['error_message'] = "Failed to add customer.";
    header('Location: ../pages/customers.php');
}
?>