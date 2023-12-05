<?php 
include '../includes/session.php'; 
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>User | Task Management Application</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- css -->
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/users.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>

<body>
<div class="container-fluid main-content user" id="mainContent">

  <?php

  if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
      $user_id = $_GET['user_id'];
  ?>

  <div class="row content">
    <div class="col-sm-3 nav-col">
      <!-- include navigation-->
      <?php include '../includes/nav.php'; ?>
    </div>
    <div class="col-sm-9 content-col">
      <div class="welcome-container">
        <p class="welcome-message"><h3 class="page-title">User Detail: <?php echo $user_id; ?></h3></p>
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
        <a class="btn back-btn" href="../pages/users.php">Back</a>  
        <a class="btn edit-btn" href="user-edit.php?user_id=<?php echo $user_id; ?>">Edit</a>  
        <a class="btn change-ps-btn" href="change-password.php?user_id=<?php echo $user_id; ?>">Change Password</a>  
      </div>

       <?php 
      $result = mysqli_query($conn, 
      "SELECT users.*, user_type.user_type as user_type_name, user_department.name as user_department_name
      FROM `users`
      LEFT JOIN `user_type` ON user_type.id = users.user_type
      LEFT JOIN `user_department` ON user_department.id = users.user_department 
      WHERE users.id=$user_id
      ");

      if ($result && mysqli_num_rows($result) > 0) {
          $user = mysqli_fetch_assoc($result);

          echo "<table class='content-table'>";          
          echo "<tr><th>User ID</th><td>{$user['id']}</td></tr>";
          echo "<tr><th>Full Name</th><td>{$user['full_name']}</td></tr>";
          echo "<tr><th>Username</th><td>{$user['username']}</td></tr>";
          echo "<tr><th>Email</th><td>{$user['email']}</td></tr>";
          echo "<tr><th>Department</th><td>{$user['user_department_name']}</td></tr>";
          echo "<tr><th>User Type</th><td>{$user['user_type_name']}</td></tr>";
          echo "<tr><th>Created At</th><td>";

          if (!empty($user['created_at']) && $user['created_at'] !== 'null' && $user['created_at'] !== '-') {
            $created_timestamp = (int)$user['created_at'];
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
          echo "User not found.";
      }
          mysqli_close($conn);
      } else {
          echo "Invalid user ID.";
      }
    ?>
   </div>
  </div>
</div>
</body>
</html>



