<!-- dashboard.php -->
<?php include '../includes/session.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Dashboard | Task Management Application</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- css -->
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container-fluid main-content" id="mainContent">
  <div class="row content">
    <div class="col-sm-3 nav-col">
      <!-- include navigation-->
      <?php include '../includes/nav.php'; ?>
    </div>
    <div class="col-sm-9 content-col">
      <div>
        <div class="welcome-container">
          <p class="welcome-message"><h3 class="page-title">Hello, <?php echo $_SESSION['username']; ?>!</h3></p>
        </div>

        <div class="row dashboard-content">
          <a href="../pages/profile.php">
            <div class="col-sm-3">
              <i class="fa fa-id-card fa-3x"></i>
              <p class="caption">My Profile</p>
            </div>
          </a>

          <a href="../pages/tasks.php">
            <div class="col-sm-3">
              <i class="fa fa-tasks fa-3x"></i>
              <p class="caption">Manage Tasks</p>
            </div>
          </a>

          <a href="../pages/customers.php">
            <div class="col-sm-3">
              <i class="fa fa-users fa-3x"></i>
              <p class="caption">Manage Customers</p>
            </div>
          </a>

          <?php 
          //only admin
          if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 1 ) { ?>
            <a href="../pages/users.php">
              <div class="col-sm-3">
                <i class="fa fa-user fa-3x"></i>
                <p class="caption">Manage Users</p>
              </div>
            </a>

            <a href="../pages/department.php">
              <div class="col-sm-3">
                <i class="fa fa-building-o fa-3x"></i>
                <p class="caption">Manage Department</p>
              </div>
            </a>
          <?php } ?>
         
          <a href="../logout.php">
            <div class="col-sm-3">
              <i class="fa fa-sign-out fa-3x"></i>
              <p class="caption">Logout</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

</div>

</body>
</html>
