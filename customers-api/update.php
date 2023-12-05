<?php
include '../includes/session.php';
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $remarks = $_POST['remarks'];

    $customer_id = $_POST['customer_id'];

    $result = mysqli_query($conn, "UPDATE customer
        SET name = '$name', email = '$email', phone = '$phone', remarks = '$remarks'
        WHERE id = $customer_id;");

    if ($result) {
        $_SESSION['success_message'] = "Customer edit successfully.";
        header("Location: ../pages/customer.php?customer_id={$customer_id}");
    } else {
        $_SESSION['error_message'] = "Failed to edit customer.";
        header("Location: ../pages/customer.php?customer_id={$customer_id}");
    }

    
    mysqli_close($conn);
} else {
   $_SESSION['error_message'] = "Failed to edit customer.";
   header("Location: ../pages/customer.php?customer_id={$customer_id}");
}
?>