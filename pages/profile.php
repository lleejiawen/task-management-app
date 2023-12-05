<?php 
include '../includes/session.php'; 
include '../includes/db.php';

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Profile | Task Management Application</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- css -->
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>

<body>
<div class="container-fluid main-content" id="mainContent">
  <div class="row content">
    <div class="col-sm-3 nav-col">
      <!-- include navigation-->
      <?php include '../includes/nav.php'; ?>
    </div>
    <div class="col-sm-9 content-col">
      <div class="welcome-container">
        <p class="welcome-message"><h3 class="page-title">Profile</h3></p>
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
      } ?>

      <div class="action-group">
        <a class="btn back-btn" href="../pages/dashboard.php">Back</a>  
        <a class="btn edit-btn" href="profile-edit.php">Edit</a>  
        <a class="btn change-ps-btn" href="change-password.php?user_id=<?php echo $user_id; ?>">Change Password</a>
      </div>

      <?php 
      $result = mysqli_query($conn, "SELECT * FROM `users` WHERE id=$user_id");

      if ($result && mysqli_num_rows($result) > 0) {
          $user = mysqli_fetch_assoc($result);

          echo "<table class='content-table'>";          
          echo "<tr><th>Username</th><td>{$user['username']}</td></tr>";
          echo "<tr><th>Full Name</th><td>{$user['full_name']}</td></tr>";
          echo "<tr><th>Email</th><td>{$user['email']}</td></tr>";
          echo "<tr><th>Created At</th><td>";
          if (!empty($user['created_at']) && $user['created_at'] !== 'null') {
            $created_at = (int)$user['created_at'];
            echo date('d/m/Y', $created_at);
          }
          echo "</td></tr>";
          echo "</table>";          

          mysqli_free_result($result);
      } 
      mysqli_close($conn);
      ?>
      </div>
  </div>
</div>


</body>
</html>



