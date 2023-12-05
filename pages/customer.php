<?php 
include '../includes/session.php'; 
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Customer | Task Management Application</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- css -->
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/customer.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>

<body>
<div class="container-fluid main-content customer" id="mainContent">

  <?php
  if (isset($_GET['customer_id']) && !empty($_GET['customer_id'])) {
      $customer_id = $_GET['customer_id'];
  ?>

  <div class="row content">
    <div class="col-sm-3 nav-col">
      <!-- include navigation-->
      <?php include '../includes/nav.php'; ?>
    </div>
    <div class="col-sm-9 content-col">
      <div class="welcome-container">
        <p class="welcome-message"><h3 class="page-title">Customer Detail: <?php echo $customer_id; ?></h3></p>
      </div>
      <?php 
        if (isset($_SESSION['success_message'])) { ?>
          <div class="alert-group success-message">
          <p><?php echo $_SESSION['success_message']; ?></p>    
        </div>
          <?php unset($_SESSION['success_message']);
        }

        if (isset($_SESSION['error_message'])) { ?>
          <div class="alert-group error-message">
          <p><?php echo $_SESSION['error_message']; ?></p>    
        </div>
          <?php unset($_SESSION['error_message']);
        }
      ?>

      <div class="action-group">
        <a class="btn back-btn" href="../pages/customers.php">Back</a>  
        <a class="btn edit-btn" href="customer-edit.php?customer_id=<?php echo $customer_id; ?>">Edit</a>  
      </div>

      <?php 
      $result = mysqli_query($conn, 
      "SELECT * , COALESCE(NULLIF(remarks, ''), '-') as remarks FROM `customer` WHERE id=$customer_id
      ");

      if ($result && mysqli_num_rows($result) > 0) {
          $customer = mysqli_fetch_assoc($result);

          echo "<table class='content-table'>";          
          echo "<tr><th> Customer ID</th><td>{$customer['id']}</td></tr>";
          echo "<tr><th>Name</th><td>{$customer['name']}</td></tr>";
          echo "<tr><th>Email</th><td>{$customer['email']}</td></tr>";
          echo "<tr><th>Phone</th><td>{$customer['phone']}</td></tr>";
          echo "<tr><th>Remarks</th><td>{$customer['remarks']}</td></tr>";
          echo "<tr><th>Created At</th><td>";
          if (!empty($customer['created_at']) && $customer['created_at'] !== 'null' && $customer['created_at'] !== '-') {
            $created_timestamp = (int)$customer['created_at'];
            if ($created_timestamp !== false && $created_timestamp !== -1) {
                echo date('d/m/Y', $created_timestamp);
            } else {
                echo '-';
            }
          } else {
              echo '-';
          }
          echo "</td></tr>";
          echo "</table>";          

          mysqli_free_result($result);
      } else {
          echo "Customer not found.";
      }
          mysqli_close($conn);
      } else {
          echo "Invalid customer ID.";
      }
    ?>
    </div>
  </div>
</div>

</body>
</html>



